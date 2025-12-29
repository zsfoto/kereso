<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * City Entity
 *
 * @property int $id
 * @property int $country_id
 * @property int $county_id
 * @property string $shortname
 * @property string $name
 * @property string|null $zip
 * @property string $lat
 * @property string $lng
 * @property string $lat2
 * @property string $lng2
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\County $county
 * @property \App\Model\Entity\Company[] $companies
 */
class City extends Entity
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
        'country_id' => true,
        'county_id' => true,
        'shortname' => true,
        'name' => true,
        'zip' => true,
        'lat' => true,
        'lng' => true,
        'lat2' => true,
        'lng2' => true,
        'country' => true,
        'county' => true,
        'companies' => true,
    ];

    // Ez hozza létre a "full_name" virtuális mezőt
    protected function _getZipAndName(): string
    {
        return $this->zip . ' ' . $this->name;
    }

}
