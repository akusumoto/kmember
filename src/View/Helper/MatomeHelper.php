<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;
use Cake\Log\Log;
use App\Model\Entity\Matome;

/**
 * Matome helper
 */
class MatomeHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function isTop($matome)
    {
        return ($matome->id === Matome::TOP);
    }


    private function replaceWord($reg, $ptn, $txt, &$replace, $direct = false)
    {
        $pre = $txt;
        if ($direct === false) {
            $txt = preg_replace('/ '.$reg.' /', ' '.$ptn.' ', $txt); // o
            $txt = preg_replace('/^'.$reg.' /',     $ptn.' ', $txt); // o
            $txt = preg_replace('/ '.$reg.'$/', ' '.$ptn,     $txt);
            $txt = preg_replace('/^'.$reg.'$/',     $ptn,     $txt);
        } else {
            $txt = preg_replace($reg, $ptn, $txt);
        }

        if ($pre !== $txt) {
            $replace = true;
        } else {
            $replace = false;
        }

        return $txt;
    }   

    public function parseWiki($text, $matomes, $html_helper)
    {
        $lines = explode("\n", $text);
        $body = "";
        $parag = '';//"<p>";
        $list_level = 0;
        //$htmlHelper = new HtmlHelper();
        $end_tags = array();
        $tmp = true;
        foreach ($lines as $line) {
            $line = trim($line);
            $is_br = true;

            // replace list items
            $matches = array();
            if (preg_match('/^(\*+) +(.*)$/', $line, $matches)) {
                $level = strlen($matches[1]);
                if ($list_level < $level){
                    $parag .= str_repeat('  ', $list_level).'<ul>'."\n";
                    array_push($end_tags, str_repeat('  ', $list_level).'</ul>');
                    $list_level++; 
                }
        
                $line = str_repeat('  ', $list_level).'<li>' . $matches[2] . '</li>';

                if ($list_level > $level) {
                    while ($list_level > $level) {
                        $tag = array_pop($end_tags);
                        $line .= $tag."\n";
                        $list_level--;
                    }
                }

                $is_br = false;
            }
            else if (preg_match('/^(#+) +(.*)$/', $line, $matches)) {
                $level = strlen($matches[1]);
                if ($list_level < $level){
                    $parag .= str_repeat('  ', $list_level).'<ol>'."\n";
                    array_push($end_tags, str_repeat('  ', $list_level).'</ol>');
                    $list_level++; 
                }
        
                $line = str_repeat('  ', $list_level).'<li>' . $matches[2] . '</li>';

                if ($list_level > $level) {
                    while ($list_level > $level) {
                        $tag = array_pop($end_tags);
                        $line .= $tag."\n";
                        $list_level--;
                    }
                }

                $is_br = false;
            }
            else if ($list_level > 0) {
                while (($tag = array_pop($end_tags)) != NULL) {
                    $parag .= $tag."\n";
                }
                $list_level = 0;
            }

            // replace charactor decorations
            $line = $this->replaceWord('\*([^ ].*)\*', '<strong>$1</strong>', $line, $tmp);
            $line = $this->replaceWord('_([^ ].*)_', '<i>$1</i>', $line, $tmp);
            $line = $this->replaceWord('\+([^ ].*)\+', '<u>$1</u>', $line, $tmp);
            $line = $this->replaceWord('-([^ ].*)-', '<s>$1</s>', $line, $tmp);
            $line = $this->replaceWord('\?\?([^ ].*)\?\?', '<q>$1</q>', $line, $tmp);
            $line = $this->replaceWord('@([^ ].*)@', '<code>$1</code>', $line, $tmp);

            // replace headlines
            $line = $this->replaceWord('/^h1\. (.*)$/', '<h3>$1</h3>', $line, $tmp, true); if ($tmp) { $is_br = false; }
            $line = $this->replaceWord('/^h2\. (.*)$/', '<h4>$1</h4>', $line, $tmp, true); if ($tmp) { $is_br = false; }
            $line = $this->replaceWord('/^h3\. (.*)$/', '<h5>$1</h5>', $line, $tmp, true); if ($tmp) { $is_br = false; }

            // replace wiki pages
            foreach ($matomes as $matome){
                $tag = '\[\[' . $matome->name . '\]\]';
                $url = $html_helper->link(h($matome->name), [$matome->id]);
                $line = $this->replaceWord($tag, $url, $line, $tmp);
            }

            // replace URLs
            $line = $this->replaceWord('(https?:\/\/[0-9a-zA-Z\-_\.\!\*\'\(\)\/%=\?]+)', '<a href="$1" target="_blank">$1</a>', $line, $tmp);
            $line = $this->replaceWord('"(.+)":(https?:\/\/[0-9a-zA-Z\-_\.\!\*\'\(\)\/%=\?]+)', '<a href="$2" target="_blank">$1</a>', $line, $tmp);

            if (strlen($line) > 0) {
                if ($is_br) {
                    $parag .= $line.'<br>'."\n";
                } else {
                    $parag .= $line."\n";
                }
            }
            else {
                if (strlen($parag) > 0) {
                    $body .= '<p>'.$parag.'</p>'."\n";
                    $parag = '';
                }
            }
        }
        $body .= '<p>'.$parag.'</p>';

        //Log::write('debug', '[body] '.$body);

        return $body;
    }
}
