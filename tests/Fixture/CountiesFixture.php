<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * CountiesFixture
 */
class CountiesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'country_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'shortname' => 'Lorem ip',
                'capitalcity' => 'Lorem ipsum dolor sit amet',
                'region' => 'Lorem ipsum dolor sit amet',
                'pos' => 1,
                'visible' => 1,
                'created' => '2025-12-29 09:03:28',
                'modified' => '2025-12-29 09:03:28',
            ],
        ];
        parent::init();
    }
}
