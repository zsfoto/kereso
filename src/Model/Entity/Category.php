<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Category Entity
 *
 * @property int $id
 * @property int|null $icon_id
 * @property string $name
 * @property string|null $name_slug
 * @property string|null $description
 * @property string $description_slug
 * @property string|null $keywords
 * @property string|null $keywords_slug
 * @property bool $visible
 * @property int $pos
 * @property string $action
 * @property int $company_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Icon $icon
 * @property \App\Model\Entity\Company[] $companies
 */
class Category extends Entity
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
        'name' => true,
        'name_slug' => true,
        'description' => true,
        'description_slug' => true,
        'keywords' => true,
        'keywords_slug' => true,
        'visible' => true,
        'pos' => true,
        'action' => true,
        'company_count' => true,
        'created' => true,
        'modified' => true,
        'icon' => true,
        'companies' => true,
    ];
}
