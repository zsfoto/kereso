<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * CountriesFixture
 */
class CountriesFixture extends TestFixture
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
                'name_hu' => 'Lorem ipsum dolor sit amet',
                'name_en' => 'Lorem ipsum dolor sit amet',
                'name_de' => 'Lorem ipsum dolor sit amet',
                'shortcode' => 'Lor',
                'currency' => 'L',
                'city_count' => 1,
                'pos' => 1,
                'visible' => 1,
                'created' => '2025-12-29 09:03:48',
                'modified' => '2025-12-29 09:03:48',
            ],
        ];
        parent::init();
    }
}
