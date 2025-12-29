<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Setup Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $name
 * @property string $slug
 * @property string $value
 * @property string $type
 * @property int $editable
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class Setup extends Entity
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
        'user_id' => true,
        'name' => true,
        'slug' => true,
        'value' => true,
        'type' => true,
        'editable' => true,
        'created' => true,
        'modified' => true,
    ];
}
