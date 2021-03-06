<?php

use yii\db\Migration;

class m160924_165416_proveedores_enh extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn('proveedores', 'paga_cajero', $this->boolean()->defaultValue(false));

    }

    public function down()
    {
        echo "m160924_165416_proveedores_enh cannot be reverted.\n";
        $this->dropColumn('proveedores', 'pago_cajero');

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
