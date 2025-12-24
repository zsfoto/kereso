<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Person Entity
 *
 * @property int $id
 * @property int|null $icon_id
 * @property int $company_id
 * @property string $name
 * @property string|null $name_slug
 * @property string|null $description
 * @property string|null $keywoords
 * @property string|null $keywoords_slug
 * @property string $phone
 * @property string|null $phone2
 * @property string|null $phone3
 * @property string|null $phone4
 * @property string|null $phone5
 * @property string|null $email
 * @property string|null $email2
 * @property string|null $web
 * @property string|null $facebook
 * @property string|null $youtube
 * @property string|null $logo
 * @property string|null $banner
 * @property bool $visible
 * @property int $pos
 * @property string $action
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Icon $icon
 * @property \App\Model\Entity\Company $company
 */
class Person extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'icon_id' => true,
        'company_id' => true,
        'name' => true,
        'name_slug' => true,
        'description' => true,
        'keywoords' => true,
        'keywoords_slug' => true,
        'phone' => true,
        'phone2' => true,
        'phone3' => true,
        'phone4' => true,
        'phone5' => true,
        'email' => true,
        'email2' => true,
        'web' => true,
        'facebook' => true,
        'youtube' => true,
        'logo' => true,
        'banner' => true,
        'visible' => true,
        'pos' => true,
        'action' => true,
        'created' => true,
        'modified' => true,
        'icon' => true,
        'company' => true,
    ];
}
