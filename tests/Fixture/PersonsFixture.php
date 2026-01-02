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
                'description_slug' => 'Lorem ipsum dolor sit amet',
                'keywords' => 'Lorem ipsum dolor sit amet',
                'keywords_slug' => 'Lorem ipsum dolor sit amet',
                'opening_time' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
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
                'created' => '2026-01-02 11:19:41',
                'modified' => '2026-01-02 11:19:41',
            ],
        ];
        parent::init();
    }
}
