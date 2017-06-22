<?php

use yii\db\Migration;

class m170613_195645_add_userid_colaboradores extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'colaborador_id', $this->integer()); // Poder separar por area laboral ej. comedor, cocina, administracion, etc.
        $this->addForeignKey('fk_user_colaborador','user','colaborador_id','colaboradores', 'id', 'CASCADE', 'CASCADE');
        //$this->createIndex('idx_user_colaborador', 'user', 'colaborador_id', 'true');

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_user_colaborador', 'user');
        $this->dropColumn('user','colaborador_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170613_195645_add_userid_colaboradores cannot be reverted.\n";

        return false;
    }
    */
}
