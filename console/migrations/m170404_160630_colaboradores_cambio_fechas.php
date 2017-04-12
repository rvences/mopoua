<?php

use yii\db\Migration;

class m170404_160630_colaboradores_cambio_fechas extends Migration
{
    public function up()
    {
        $this->alterColumn('colaboradores', 'fingreso', $this->date());
        $this->alterColumn('colaboradores', 'fbaja', $this->date());
        $this->dropIndex('rfc', 'colaboradores');

    }

    public function down()
    {
        $this->alterColumn('colaboradores', 'fingreso', $this->dateTime());
        $this->alterColumn('colaboradores', 'fbaja', $this->dateTime());
        $this->createIndex('rfc', 'colaboradores', 'rfc', $unique = true );

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
