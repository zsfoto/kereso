<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Icon Entity
 *
 * @property int $id
 * @property string $name
 * @property string $filename
 * @property bool $visible
 * @property int|null $pos
 * @property \Cake\I18n\DateTime|null $last_used
 * @property int|null $adcategory_count
 * @property int|null $ad_count
 * @property int|null $category_count
 * @property int|null $company_count
 * @property int|null $person_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Adcategory[] $adcategories
 * @property \App\Model\Entity\Ads1[] $ads1
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Company[] $companies
 * @property \App\Model\Entity\Person[] $persons
 */
class Icon extends Entity
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
        'name' => true,
        'filename' => true,
        'visible' => true,
        'pos' => true,
        'last_used' => true,
        'adcategory_count' => true,
        'ad_count' => true,
        'category_count' => true,
        'company_count' => true,
        'person_count' => true,
        'created' => true,
        'modified' => true,
        'adcategories' => true,
        'ads1' => true,
        'categories' => true,
        'companies' => true,
        'persons' => true,
    ];
}
