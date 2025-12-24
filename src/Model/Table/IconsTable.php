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
 * Icons Model
 *
 * @property \App\Model\Table\AdcategoriesTable&\Cake\ORM\Association\HasMany $Adcategories
 * @property \App\Model\Table\Ads1Table&\Cake\ORM\Association\HasMany $Ads1
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\HasMany $Categories
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\HasMany $Companies
 * @property \App\Model\Table\PersonsTable&\Cake\ORM\Association\HasMany $Persons
 *
 * @method \App\Model\Entity\Icon newEmptyEntity()
 * @method \App\Model\Entity\Icon newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Icon> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Icon get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Icon findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Icon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Icon> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Icon|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Icon saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Icon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Icon>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Icon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Icon> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Icon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Icon>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Icon>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Icon> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IconsTable extends Table
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

        $this->setTable('icons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('JeffAdmin5.Datepicker');

        //$this->hasMany('Adcategories', [
        //    'foreignKey' => 'icon_id',
        //]);
        //$this->hasMany('Ads1', [
        //    'foreignKey' => 'icon_id',
        //]);
        $this->hasMany('Categories', [
            'foreignKey' => 'icon_id',
        ]);
        $this->hasMany('Companies', [
            'foreignKey' => 'icon_id',
        ]);
        $this->hasMany('Persons', [
            'foreignKey' => 'icon_id',
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
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('filename')
            ->maxLength('filename', 250)
            ->requirePresence('filename', 'create')
            ->notEmptyString('filename');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->allowEmptyString('pos');

        $validator
            ->dateTime('last_used')
            ->allowEmptyDateTime('last_used');

        $validator
            ->nonNegativeInteger('adcategory_count')
            ->allowEmptyString('adcategory_count');

        $validator
            ->nonNegativeInteger('ad_count')
            ->allowEmptyString('ad_count');

        $validator
            ->nonNegativeInteger('category_count')
            ->allowEmptyString('category_count');

        $validator
            ->nonNegativeInteger('company_count')
            ->allowEmptyString('company_count');

        $validator
            ->nonNegativeInteger('person_count')
            ->allowEmptyString('person_count');

        return $validator;
    }
}
