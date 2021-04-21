<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddSoftDeleteSlamsUsers extends AbstractMigration
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
        foreach (['slams_users'] as $tableName) {
            $table = $this->table($tableName);
            $table->addColumn('deleted', 'datetime', ['default' => null, 'null' => true]);
            $table->update();
        }
    }
}
