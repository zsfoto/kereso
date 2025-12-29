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
 * Companies Model
 *
 * @property \App\Model\Table\IconsTable&\Cake\ORM\Association\BelongsTo $Icons
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\PersonsTable&\Cake\ORM\Association\HasMany $Persons
 *
 * @method \App\Model\Entity\Company newEmptyEntity()
 * @method \App\Model\Entity\Company newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Company> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Company findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Company> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Company saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Icons' => ['company_count'],
            'Categories' => ['company_count'],
        ]);
		$this->addBehavior('JeffAdmin5.Datepicker');

        $this->belongsTo('Icons', [
            'foreignKey' => 'icon_id',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Persons', [
            'foreignKey' => 'company_id',
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
            ->scalar('icon_id')
            ->maxLength('icon_id', 64)
            ->allowEmptyString('icon_id');

        $validator
            ->nonNegativeInteger('category_id')
            ->notEmptyString('category_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('name_slug')
            ->maxLength('name_slug', 250)
            ->requirePresence('name_slug', 'create')
            ->notEmptyString('name_slug');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 2000)
            ->allowEmptyString('keywords');

        $validator
            ->scalar('keywords_slug')
            ->maxLength('keywords_slug', 2000)
            ->allowEmptyString('keywords_slug');

        $validator
            ->nonNegativeInteger('city_id')
            ->notEmptyString('city_id');

        $validator
            ->scalar('address')
            ->maxLength('address', 250)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('house_number')
            ->maxLength('house_number', 20)
            ->requirePresence('house_number', 'create')
            ->notEmptyString('house_number');

        $validator
            ->scalar('description')
            ->maxLength('description', 2000)
            ->allowEmptyString('description');

        $validator
            ->scalar('description_slug')
            ->maxLength('description_slug', 2000)
            ->allowEmptyString('description_slug');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 30)
            ->allowEmptyString('phone');

        $validator
            ->scalar('phone2')
            ->maxLength('phone2', 30)
            ->allowEmptyString('phone2');

        $validator
            ->scalar('web')
            ->maxLength('web', 250)
            ->allowEmptyString('web');

        $validator
            ->scalar('email')
            ->maxLength('email', 100)
            ->allowEmptyString('email');

        $validator
            ->scalar('goole_map_url')
            ->maxLength('goole_map_url', 2048)
            ->allowEmptyString('goole_map_url');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 30)
            ->allowEmptyString('longitude');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 30)
            ->allowEmptyString('latitude');

        $validator
            ->nonNegativeInteger('maximum_distance')
            ->notEmptyString('maximum_distance');

        $validator
            ->date('date_from')
            ->allowEmptyDate('date_from');

        $validator
            ->date('date_to')
            ->allowEmptyDate('date_to');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        $validator
            ->scalar('action')
            ->maxLength('action', 20)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->nonNegativeInteger('person_count')
            ->notEmptyString('person_count');

        $validator
            ->allowEmptyFile('file_logo')
            ->add('file_logo', 'fileUpload', [
                'errorField' => '0',
                'rule' => ['uploadedFile', ['optional' => true]], // Ellenőrzi, hogy sikeres volt-e a feltöltés (ha nem üres)
                'message' => 'Hiba történt a fájl feltöltésekor (lehet, hogy túl nagy a fájl vagy nem megfelelő a formátuma).',
            ])
            // MIME típus ellenőrzése (biztonságosabb)
            ->add('file_logo', 'mimeType', [
                'errorField' => '0',
                'rule' => ['mimeType', ['image/jpg', 'image/jpeg', 'image/png']],
                'message' => 'Érvénytelen fájltípus.',
            ])
            // Kiterjesztés ellenőrzése
            ->add('file_logo', 'extension', [
                'errorField' => '0',
                'rule' => ['extension', ['png', 'jpg', 'jpeg']], // Csak ezeket engedi
                'message' => 'Csak png, jpg vagy jpeg fájl tölthető fel.',
            ])            ;


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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => '1']);
        $rules->add($rules->existsIn(['city_id'], 'Cities'), ['errorField' => '2']);

        return $rules;
    }
}
