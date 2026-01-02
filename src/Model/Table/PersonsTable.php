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
 * Persons Model
 *
 * @property \App\Model\Table\IconsTable&\Cake\ORM\Association\BelongsTo $Icons
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\Person newEmptyEntity()
 * @method \App\Model\Entity\Person newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Person> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Person findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Person> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Person>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Person>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Person>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Person> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Person>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Person>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Person>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Person> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class PersonsTable extends Table
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

        $this->setTable('persons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Icons' => ['person_count'],
            'Companies' => ['person_count'],
        ]);

        $this->belongsTo('Icons', [
            'foreignKey' => 'icon_id',
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('icon_id')
            ->allowEmptyString('icon_id');

        $validator
            ->nonNegativeInteger('company_id')
            ->notEmptyString('company_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('name_slug')
            ->maxLength('name_slug', 200)
            ->requirePresence('name_slug', 'create')
            ->notEmptyString('name_slug');

        $validator
            ->scalar('description')
            ->maxLength('description', 2000)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('description_slug')
            ->maxLength('description_slug', 2000)
            ->requirePresence('description_slug', 'create')
            ->notEmptyString('description_slug');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 2000)
            ->requirePresence('keywords', 'create')
            ->notEmptyString('keywords');

        $validator
            ->scalar('keywords_slug')
            ->maxLength('keywords_slug', 2000)
            ->requirePresence('keywords_slug', 'create')
            ->notEmptyString('keywords_slug');

        $validator
            ->scalar('opening_time')
            ->requirePresence('opening_time', 'create')
            ->notEmptyString('opening_time');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('phone2')
            ->maxLength('phone2', 20)
            ->allowEmptyString('phone2');

        $validator
            ->scalar('phone3')
            ->maxLength('phone3', 20)
            ->allowEmptyString('phone3');

        $validator
            ->scalar('phone4')
            ->maxLength('phone4', 20)
            ->allowEmptyString('phone4');

        $validator
            ->scalar('phone5')
            ->maxLength('phone5', 20)
            ->allowEmptyString('phone5');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('email2')
            ->maxLength('email2', 50)
            ->allowEmptyString('email2');

        $validator
            ->scalar('web')
            ->maxLength('web', 100)
            ->allowEmptyString('web');

        $validator
            ->scalar('facebook')
            ->maxLength('facebook', 100)
            ->allowEmptyString('facebook');

        $validator
            ->scalar('youtube')
            ->maxLength('youtube', 100)
            ->allowEmptyString('youtube');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 250)
            ->allowEmptyString('logo');

        $validator
            ->scalar('banner')
            ->maxLength('banner', 250)
            ->allowEmptyString('banner');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        $validator
            ->scalar('action')
            ->maxLength('action', 20)
            ->notEmptyString('action');

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
        $rules->add($rules->existsIn(['icon_id'], 'Icons'), ['errorField' => '0']);
        $rules->add($rules->existsIn(['company_id'], 'Companies'), ['errorField' => '1']);

        return $rules;
    }
}
