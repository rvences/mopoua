<?php

use yii\db\Migration;

class m161003_141600_roles_usuarios extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'role', $this->string(20));

    }

    public function down()
    {
        echo "m161003_141600_roles_usuarios cannot be reverted.\n";
        echo "Eliminando la columna de role\n";
        $this->dropColumn('user', 'role');

        return true;

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
