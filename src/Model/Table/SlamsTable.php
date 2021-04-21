<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Slams Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $User
 * @property \App\Model\Table\DatesTable&\Cake\ORM\Association\HasMany $Dates
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 * @property \App\Model\Table\FilesTable&\Cake\ORM\Association\BelongsToMany $Files
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Slam newEmptyEntity()
 * @method \App\Model\Entity\Slam newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Slam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Slam get($primaryKey, $options = [])
 * @method \App\Model\Entity\Slam findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Slam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Slam[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Slam|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Slam saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SlamsTable extends Table
{
    use SoftDeleteTrait;

    const STATES = [
        'DE' => [
            'DE_BW',
            'DE_BY',
            'DE_BE',
            'DE_BB',
            'DE_HB',
            'DE_HH',
            'DE_HE',
            'DE_NI',
            'DE_MV',
            'DE_NW',
            'DE_RP',
            'DE_SL',
            'DE_SN',
            'DE_ST',
            'DE_SH',
            'DE_TH',
        ],
        'CH' => [
            'CH',
        ],
        'AT' => [
            'AT',
        ],
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('slams');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Dates', [
            'foreignKey' => 'slam_id',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'slam_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'slams_tags',
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'slam_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'slams_users',
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'slam_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'files_slams',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->requirePresence('slug', 'update')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('venue')
            ->maxLength('venue', 191)
            ->requirePresence('venue', 'create')
            ->notEmptyString('venue');

        $validator
            ->scalar('address')
            ->maxLength('address', 191)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 191)
            ->requirePresence('city', 'create')
            ->notEmptyString('city');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 5)
            ->requirePresence('zip', 'create')
            ->notEmptyString('zip');

        $validator
            ->scalar('contact')
            ->allowEmptyString('contact');

        $validator
            ->scalar('www')
            ->maxLength('www', 191)
            ->requirePresence('www', 'create')
            ->notEmptyString('www');

        $validator
            ->scalar('state')
            ->maxLength('state', 5)
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->decimal('longitude')
            ->allowEmptyString('longitude');

        $validator
            ->decimal('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->boolean('sleeping')
            ->allowEmptyString('sleeping');

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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = strtolower(substr($sluggedTitle, 0, 191));
        }

        if ($entity->isDirty('city') || $entity->isDirty('zip') || $entity->isDirty('address')) {
            switch (substr($entity->state, 0, 2)) {
                case 'AT': $country = 'Austria'; break;
                case 'CH': $country = 'Switzerland'; break;
                case 'DE': $country = 'Germany'; break;
            }

            if ($entity->address && $entity->city) {
                $url = "https://nominatim.openstreetmap.org/";
                $nominatim = new \maxh\Nominatim\Nominatim($url);
                $search = $nominatim
                    ->newSearch()
                    ->country($country)
                    ->city($entity->city)
                    ->postalCode($entity->zip)
                    ->street($entity->address);
                $result = $nominatim->find($search);

                if (!empty($result)) {
                    $entity->longitude = $result[0]['lon'];
                    $entity->latitude = $result[0]['lat'];
                }
                #debug($search); debug($result); die();
            }
        }
    }

    public static function getStates()
    {
        $states = self::STATES;

        $translatedStates = [];

        foreach ($states as $country => $countryStates) {
            $translatedStates[__($country)] = [];
            foreach ($countryStates as $countryState) {
                $translatedStates[__($country)][$countryState] = __($countryState);
            }
        }

        return $translatedStates;
    }
}
