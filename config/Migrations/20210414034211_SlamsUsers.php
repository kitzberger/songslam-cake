<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class SlamsUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('slams_users', ['id' => false, 'primary_key' => ['slam_id', 'user_id']]);
        $table->addColumn('slam_id', 'integer');
        $table->addColumn('user_id', 'integer');
        $table->create();

        $table->addForeignKey('slam_id', 'slams', 'id');
        $table->addForeignKey('user_id', 'users', 'id');
        $table->save();
    }
}
