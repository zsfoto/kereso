<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;


use App\Model\Table\IconsTable;
use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * App\Model\Table\IconsTable Test Case
 */
class IconsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IconsTable
     */
    protected $Icons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Icons',
        'app.Categories',
        'app.Companies',
        'app.Persons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Icons') ? [] : ['className' => IconsTable::class];
        $this->Icons = $this->getTableLocator()->get('Icons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Icons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\IconsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
