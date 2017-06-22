<?php

use yii\db\Migration;

class m170619_232756_tarea_user_a_colaboradores extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk_tareas5_2_user', 'tareas');
        $this->addForeignKey('fk_tareas5_2_user', 'tareas', 'asignado_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');

        $this->dropForeignKey('fk_tareas0_2_user', 'tareas');
        $this->addForeignKey('fk_tareas0_2_user', 'tareas', 'user_solicita_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');

        $this->dropForeignKey('fk_tareas1_2_user', 'tareas');
        $this->addForeignKey('fk_tareas1_2_user', 'tareas', 'user_realizo_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');

        $this->dropForeignKey('fk_user_colaborador', 'user');
        $this->addForeignKey('fk_user_colaborador', 'user', 'colaborador_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');


    }

    public function safeDown()
    {
        echo "m170619_232756_tarea_user_a_colaboradores cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170619_232756_tarea_user_a_colaboradores cannot be reverted.\n";

        return false;
    }
    */
}
