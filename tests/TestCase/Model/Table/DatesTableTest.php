<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DatesTable Test Case
 */
class DatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DatesTable
     */
    protected $Dates;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Dates',
        'app.Users',
        'app.Slams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Dates') ? [] : ['className' => DatesTable::class];
        $this->Dates = TableRegistry::getTableLocator()->get('Dates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Dates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
