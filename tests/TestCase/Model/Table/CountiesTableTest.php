<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;


use App\Model\Table\CountiesTable;
use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * App\Model\Table\CountiesTable Test Case
 */
class CountiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CountiesTable
     */
    protected $Counties;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Counties',
        'app.Countries',
        'app.Cities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Counties') ? [] : ['className' => CountiesTable::class];
        $this->Counties = $this->getTableLocator()->get('Counties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Counties);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CountiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CountiesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
