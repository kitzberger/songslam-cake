<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTypeToSlams extends AbstractMigration
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
        $table = $this->table('slams');
        $table->addColumn('type', 'string', ['default' => null, 'null' => true, 'limit' => 24]);
        $table->update();
    }
}
