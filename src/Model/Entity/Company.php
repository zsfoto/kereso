<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Company Entity
 *
 * @property int $id
 * @property string|null $icon_id
 * @property int $category_id
 * @property string|null $logo
 * @property string|null $banner
 * @property string $name
 * @property string $name_slug
 * @property string|null $keywords
 * @property string|null $keywords_slug
 * @property int $city_id
 * @property string $address
 * @property string $house_number
 * @property string|null $description
 * @property string|null $description_slug
 * @property string|null $longitude
 * @property string|null $latitude
 * @property int $maximum_distance
 * @property \Cake\I18n\Date|null $date_from
 * @property \Cake\I18n\Date|null $date_to
 * @property bool $visible
 * @property int $pos
 * @property string $action
 * @property int $person_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Icon $icon
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Person[] $persons
 */
class Company extends Entity
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
        'category_id' => true,
        'logo' => true,
        'logo_ext' => true,
        'banner' => true,
        'banner_ext' => true,
        'name' => true,
        'name_slug' => true,
        'keywords' => true,
        'keywords_slug' => true,
        'city_id' => true,
        'address' => true,
        'house_number' => true,
        'description' => true,
        'description_slug' => true,

        'phone' => true,
        'phone2' => true,
        'web' => true,
        'email' => true,
        'google_map_url' => true,

        'longitude' => true,
        'latitude' => true,
        'maximum_distance' => true,
        'date_from' => true,
        'date_to' => true,
        'visible' => true,
        'pos' => true,
        'action' => true,
        'person_count' => true,
        'created' => true,
        'modified' => true,
        'icon' => true,
        'category' => true,
        'persons' => true,
    ];
}
