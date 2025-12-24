<?php
declare(strict_types=1);

namespace App\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * PersonsFixture
 */
class PersonsFixture extends TestFixture
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
                'icon_id' => 1,
                'company_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'name_slug' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'keywoords' => 'Lorem ipsum dolor sit amet',
                'keywoords_slug' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor ',
                'phone2' => 'Lorem ipsum dolor ',
                'phone3' => 'Lorem ipsum dolor ',
                'phone4' => 'Lorem ipsum dolor ',
                'phone5' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor sit amet',
                'email2' => 'Lorem ipsum dolor sit amet',
                'web' => 'Lorem ipsum dolor sit amet',
                'facebook' => 'Lorem ipsum dolor sit amet',
                'youtube' => 'Lorem ipsum dolor sit amet',
                'logo' => 'Lorem ipsum dolor sit amet',
                'banner' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'action' => 'Lorem ipsum dolor ',
                'created' => '2025-12-24 18:37:11',
                'modified' => '2025-12-24 18:37:11',
            ],
        ];
        parent::init();
    }
}
