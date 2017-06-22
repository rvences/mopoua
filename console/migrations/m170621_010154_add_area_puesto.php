<?php

use yii\db\Migration;

class m170621_010154_add_area_puesto extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /***************** CATALOGOS AREA PUESTOS PARA AGRUPAR A COLABORADORES ***********************/

        $this->createTable('catareapuesto', [
            'id'=> $this->primaryKey(),
            'area' => $this->string('20')->notNull(),
        ], $tableOptions);

        $this->batchInsert('catareapuesto',
            array('area'),
            array(
                [ 'Comedor'],
                [ 'Cocina'],
                [ 'Administrativo'],
                [ 'Barra Alcohol'],
            ));

        $this->addColumn('catpuestos','area_id', $this->integer());

        $this->update('catpuestos',['area_id' => 1],  ['area_id' => null]);

        $this->addForeignKey('fk_catpuesto_2_areapuesto', 'catpuestos','area_id', 'catareapuesto', 'id', 'RESTRICT', 'RESTRICT');


    }

    public function safeDown()
    {
        echo "m170621_010154_add_area_puesto cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170621_010154_add_area_puesto cannot be reverted.\n";

        return false;
    }
    */
}
