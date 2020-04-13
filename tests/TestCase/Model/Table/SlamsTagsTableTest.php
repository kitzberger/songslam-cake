<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SlamsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SlamsTagsTable Test Case
 */
class SlamsTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SlamsTagsTable
     */
    protected $SlamsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SlamsTags',
        'app.Slams',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SlamsTags') ? [] : ['className' => SlamsTagsTable::class];
        $this->SlamsTags = TableRegistry::getTableLocator()->get('SlamsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SlamsTags);

        parent::tearDown();
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
