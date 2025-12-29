<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * CitiesFixture
 */
class CitiesFixture extends TestFixture
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
                'county_id' => 1,
                'shortname' => 'Lorem ip',
                'name' => 'Lorem ipsum dolor sit amet',
                'zip' => 'Lorem ip',
                'lat' => 'Lorem ipsum dolor ',
                'lng' => 'Lorem ipsum dolor ',
                'lat2' => 'Lorem ipsum dolor ',
                'lng2' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
