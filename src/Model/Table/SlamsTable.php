<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Table\Traits\GeolocationTrait;
use App\Model\Table\Traits\StateTrait;
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
    use StateTrait;
    use GeolocationTrait { beforeSave as geolocationTraitBeforeSave; }

    const TYPES = [
        self::TYPE_SONGSLAM,
        self::TYPE_OPENSTAGE,
        self::TYPE_OTHER,
    ];

    const TYPE_SONGSLAM  = 'songslam';
    const TYPE_OPENSTAGE = 'openstage';
    const TYPE_OTHER     = 'other';

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
            ->scalar('type')
            ->maxLength('type', 24)
            ->requirePresence('title', 'create')
            ->notEmptyString('type');

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

        $this->geolocationTraitBeforeSave($event, $entity, $options);
    }

    public static function getTypes()
    {
        $types = [];

        foreach (self::TYPES as $type) {
            $types[$type] = __('songslam.type.' . $type);
        }

        return $types;
    }
}
