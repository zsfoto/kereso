<?php
declare(strict_types=1);

namespace App\Model\Table;


use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Countries Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 * @property \App\Model\Table\CountiesTable&\Cake\ORM\Association\HasMany $Counties
 *
 * @method \App\Model\Entity\Country newEmptyEntity()
 * @method \App\Model\Entity\Country newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Country> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Country get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Country findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Country> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Country|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Country saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('countries');
        $this->setDisplayField('name_hu');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Cities', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Counties', [
            'foreignKey' => 'country_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name_hu')
            ->maxLength('name_hu', 100)
            ->requirePresence('name_hu', 'create')
            ->notEmptyString('name_hu');

        $validator
            ->scalar('name_en')
            ->maxLength('name_en', 100)
            ->requirePresence('name_en', 'create')
            ->notEmptyString('name_en');

        $validator
            ->scalar('name_de')
            ->maxLength('name_de', 100)
            ->requirePresence('name_de', 'create')
            ->notEmptyString('name_de');

        $validator
            ->scalar('shortcode')
            ->maxLength('shortcode', 5)
            ->requirePresence('shortcode', 'create')
            ->notEmptyString('shortcode');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->requirePresence('currency', 'create')
            ->notEmptyString('currency');

        $validator
            ->nonNegativeInteger('city_count')
            ->requirePresence('city_count', 'create')
            ->notEmptyString('city_count');

        $validator
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmptyString('pos');

        $validator
            ->requirePresence('visible', 'create')
            ->notEmptyString('visible');

        return $validator;
    }
}
