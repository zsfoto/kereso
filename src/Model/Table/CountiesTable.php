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
 * Counties Model
 *
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 *
 * @method \App\Model\Entity\County newEmptyEntity()
 * @method \App\Model\Entity\County newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\County> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\County get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\County findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\County patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\County> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\County|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\County saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\County>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\County>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\County>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\County> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\County>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\County>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\County>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\County> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountiesTable extends Table
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

        $this->setTable('counties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'county_id',
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
            ->nonNegativeInteger('country_id')
            ->notEmptyString('country_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('shortname')
            ->maxLength('shortname', 10)
            ->requirePresence('shortname', 'create')
            ->notEmptyString('shortname');

        $validator
            ->scalar('capitalcity')
            ->maxLength('capitalcity', 100)
            ->requirePresence('capitalcity', 'create')
            ->notEmptyString('capitalcity');

        $validator
            ->scalar('region')
            ->maxLength('region', 100)
            ->requirePresence('region', 'create')
            ->notEmptyString('region');

        $validator
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmptyString('pos');

        $validator
            ->requirePresence('visible', 'create')
            ->notEmptyString('visible');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['country_id'], 'Countries'), ['errorField' => '0']);

        return $rules;
    }
}
