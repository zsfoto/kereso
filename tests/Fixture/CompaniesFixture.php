<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * CompaniesFixture
 */
class CompaniesFixture extends TestFixture
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
                'icon_id' => 'Lorem ipsum dolor sit amet',
                'category_id' => 1,
                'logo' => 'Lorem ipsum dolor sit amet',
                'banner' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'name_slug' => 'Lorem ipsum dolor sit amet',
                'keywords' => 'Lorem ipsum dolor sit amet',
                'keywords_slug' => 'Lorem ipsum dolor sit amet',
                'city_id' => 1,
                'address' => 'Lorem ipsum dolor sit amet',
                'house_number' => 'Lorem ipsum dolor ',
                'description' => 'Lorem ipsum dolor sit amet',
                'description_slug' => 'Lorem ipsum dolor sit amet',
                'longitude' => 'Lorem ipsum dolor sit amet',
                'latitude' => 'Lorem ipsum dolor sit amet',
                'maximum_distance' => 1,
                'date_from' => '2025-12-24',
                'date_to' => '2025-12-24',
                'visible' => 1,
                'pos' => 1,
                'action' => 'Lorem ipsum dolor ',
                'person_count' => 1,
                'created' => '2025-12-24 18:34:30',
                'modified' => '2025-12-24 18:34:30',
            ],
        ];
        parent::init();
    }
}
