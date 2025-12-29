<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * IconsFixture
 */
class IconsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'filename' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'last_used' => '2025-12-25 10:19:15',
                'adcategory_count' => 1,
                'ad_count' => 1,
                'category_count' => 1,
                'company_count' => 1,
                'person_count' => 1,
                'created' => '2025-12-25 10:19:15',
                'modified' => '2025-12-25 10:19:15',
            ],
        ];
        parent::init();
    }
}
