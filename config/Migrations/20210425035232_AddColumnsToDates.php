<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddColumnsToDates extends AbstractMigration
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
        $table = $this->table('dates');
        $table->addColumn('description', 'text', ['default' => null, 'null' => true]);
        $table->addColumn('moderator', 'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('contact',   'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('venue',     'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('www',       'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('address',   'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('zip',       'string', ['default' => null, 'null' => true, 'limit' => 5]);
        $table->addColumn('city',      'string', ['default' => null, 'null' => true, 'limit' => 191]);
        $table->addColumn('state',     'string', ['default' => null, 'null' => true, 'limit' => 5]);
        $table->addColumn('longitude', 'decimal', ['default' => null, 'null' => true, 'precision' => 10, 'scale' => 8]);
        $table->addColumn('latitude',  'decimal', ['default' => null, 'null' => true, 'precision' => 10, 'scale' => 8]);
        $table->update();
    }
}
