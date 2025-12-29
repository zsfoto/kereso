<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Country Entity
 *
 * @property int $id
 * @property string $name_hu
 * @property string $name_en
 * @property string $name_de
 * @property string $shortcode
 * @property string $currency
 * @property int $city_count
 * @property int $pos
 * @property int $visible
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\County[] $counties
 */
class Country extends Entity
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
        'name_hu' => true,
        'name_en' => true,
        'name_de' => true,
        'shortcode' => true,
        'currency' => true,
        'city_count' => true,
        'pos' => true,
        'visible' => true,
        'created' => true,
        'modified' => true,
        'cities' => true,
        'counties' => true,
    ];
}
