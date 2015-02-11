<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BloodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BloodsTable Test Case
 */
class BloodsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Bloods' => 'app.bloods',
        'MemberHistories' => 'app.member_histories',
        'Members' => 'app.members',
        'Parts' => 'app.parts',
        'Sexes' => 'app.sexes',
        'MemberTypes' => 'app.member_types',
        'Statuses' => 'app.statuses',
        'Histories' => 'app.histories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bloods') ? [] : ['className' => 'App\Model\Table\BloodsTable'];
        $this->Bloods = TableRegistry::get('Bloods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bloods);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
