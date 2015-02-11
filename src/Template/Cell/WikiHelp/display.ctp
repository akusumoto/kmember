<div class="large-10 columns">
    <h6>Matome Markup Help</h6>
    <table>
        <thead>
            <tr>
                <th><?= __('LABEL') ?></th>
                <th><?= __('CODE') ?></th>
                <th><?= __('VIEW') ?></th>
            </tr>
        </thead>
        <tbody> 
            <tr>
                <td><?= __('Strong') ?></td>
                <td>*Strong*</td>
                <td><strong>Strong</strong></td>
            </tr>
            <tr>
                <td><?= __('Italic') ?></td>
                <td>_Italic_</td>
                <td><i>Italic</i></td>
            </tr>
            <tr>
                <td><?= __('Underline') ?></td>
                <td>+Underline+</td>
                <td><u>Underline</u></td>
            </tr>
            <tr>
                <td><?= __('Deleted') ?></td>
                <td>-Deleted-</td>
                <td><s>Deleted</s></td>
            </tr>
            <tr>
                <td><?= __('Quote') ?></td>
                <td>??Quote??</td>
                <td><q>Quote</q></td>
            </tr>
<!--
            <tr>
                <td><?= __('Important') ?></td>
                <td>
&lt;important&gt;<br>
Important<br>
string<br>
&lt;/important&gt;
                </td>
                <td>
<p class="important">
Important <br>
string
</p>
                </td>
            </tr>
-->
            <tr>
                <td><?= __('Inline Code') ?></td>
                <td>@Inline Code@</td>
                <td><code>Inline Code</code></td>
            </tr>
            <tr>
                <td>Preformatted text</td>
                <td>
&lt;pre&gt;
 lines
 of code
&lt;/pre&gt;
                </td>
                <td>
<pre>
 lines
 of code
</pre>  
                </td>
            </tr>
            <tr>
                <td><?= __('Unordered List') ?></td>
                <td>
* Item 1<br>
* Item 2    
                </td>
                <td>
<ul>
<li>Item 1</li>
<li>Item 2</li>
</ul>
                </td>
            </tr>
            <tr>
                <td><?= __('Ordered List') ?></td>
                <td>
# Item 1<br>
# Item 2    
                </td>
                <td>
<ol>
<li>Item 1</li>
<li>Item 2</li>
</ol>
                </td>
            </tr>
            <tr>
                <td><?= __('Heading 1') ?></td>
                <td>h1. Title 1</td>
                <td><h3>Title 1</h3></td>
            </tr>
            <tr>
                <td><?= __('Heading 2') ?></td>
                <td>h2. Title 2</td>
                <td><h4>Title 2</h4></td>
            </tr>
            <tr>
                <td><?= __('Heading 3') ?></td>
                <td>h3. Title 3</td>
                <td><h5>Title 3</h5></td>
            </tr>
            <tr>
                <td><?= __('Hyperlink') ?></td>
                <td>http://foo.bar</td>
                <td><a href='http://foo.bar'>http://foo.bar</a></td>
            </tr>
            <tr>
                <td><?= __('Hyperlink with a name') ?></td>
                <td>"Foo":http://foo.bar</td>
                <td><a href='http://foo.bar'>Foo</a></td>
            </tr>
            <tr>
                <td><?= __('Link to a Matome page') ?></td>
                <td>[[TOP]]</td>
                <td><a href='/member/matome'>TOP</a></td>
            </tr>
        </tbody>
    <table>
</div>
