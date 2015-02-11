<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PartsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PartsController Test Case
 */
class PartsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Parts' => 'app.parts',
        'MemberHistories' => 'app.member_histories',
        'Members' => 'app.members',
        'Sexes' => 'app.sexes',
        'Bloods' => 'app.bloods',
        'MemberTypes' => 'app.member_types',
        'Statuses' => 'app.statuses',
        'Histories' => 'app.histories'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
