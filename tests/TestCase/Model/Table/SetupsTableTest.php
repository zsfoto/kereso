<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;


use App\Model\Table\SetupsTable;
use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * App\Model\Table\SetupsTable Test Case
 */
class SetupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SetupsTable
     */
    protected $Setups;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Setups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Setups') ? [] : ['className' => SetupsTable::class];
        $this->Setups = $this->getTableLocator()->get('Setups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Setups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\SetupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\SetupsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
