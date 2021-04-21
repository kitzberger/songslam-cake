<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * SlamsUsers Model
 *
 * @property \App\Model\Table\SlamsTable&\Cake\ORM\Association\BelongsTo $Slams
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\SlamsUser newEmptyEntity()
 * @method \App\Model\Entity\SlamsUser newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SlamsUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SlamsUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\SlamsUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SlamsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SlamsUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SlamsUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SlamsUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SlamsUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlamsUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlamsUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlamsUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SlamsUsersTable extends Table
{
    use SoftDeleteTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('slams_users');
        $this->setDisplayField('slam_id');
        $this->setPrimaryKey(['slam_id', 'user_id']);

        $this->belongsTo('Slams', [
            'foreignKey' => 'slam_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['slam_id'], 'Slams'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
