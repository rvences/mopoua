<?php

use yii\db\Migration;

class m160930_184247_finaliza_caja extends Migration
{
    public function up()
    {
        $this->dropColumn('arqueo', 'montoadeudo');
        $this->dropColumn('arqueo', 'montoapertura');
        $this->dropColumn('arqueo', 'montocierre');
        $this->dropColumn('arqueo', 'montoingreso');
        $this->dropColumn('arqueo', 'montoegreso');
        $this->dropColumn('arqueo', 'montoretiro');
        $this->dropColumn('arqueo', 'liquidoadeudo');

        $this->addColumn('arqueo', 'propina', $this->money(9,2));
        $this->addColumn('arqueo', 'clave1', $this->char(8));
        $this->addColumn('arqueo', 'clave2', $this->char(8));
        $this->addColumn('arqueo', 'usercontinua', $this->string());


    }

    public function down()
    {
        echo "m160930_184247_finaliza_caja cannot be reverted.\n";
        $this->dropColumn('arqueo', 'propina');
        $this->dropColumn('arqueo', 'clave1');
        $this->dropColumn('arqueo', 'clave2');
        $this->dropColumn('arqueo', 'usercontinua');

        $this->addColumn('arqueo', 'montoadeudo', $this->money(9,2));
        $this->addColumn('arqueo', 'montoapertura', $this->money(9,2));
        $this->addColumn('arqueo', 'montocierre', $this->money(9,2));
        $this->addColumn('arqueo', 'montoingreso', $this->money(9,2));
        $this->addColumn('arqueo', 'montoegreso', $this->money(9,2));
        $this->addColumn('arqueo', 'montoretiro', $this->money(9,2));
        $this->addColumn('arqueo', 'liquidoadeudo', $this->boolean()->defaultValue(false));

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
