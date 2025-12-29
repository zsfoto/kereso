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
 * Setups Model
 *
 * @method \App\Model\Entity\Setup newEmptyEntity()
 * @method \App\Model\Entity\Setup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Setup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Setup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Setup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Setup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Setup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SetupsTable extends Table
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

        $this->setTable('setups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('user_id')
            ->maxLength('user_id', 36)
            ->notEmptyString('user_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('value')
            ->maxLength('value', 4294967295)
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->scalar('type')
            ->maxLength('type', 10)
            ->notEmptyString('type');

        $validator
            ->notEmptyString('editable');

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => '0']);

        return $rules;
    }
}
