<?php

use yii\db\Migration;

class m160908_192334_clave_presupuestal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%clavepresupuestal}}', [
            'id' => $this->primaryKey(),
            'clavepresupuestal' => $this->string(20)->notNull() . " COMMENT ' Clave Alfanumérica en la que se agrupan los insumos' ",
            'descripcion' => $this->string()->notNull() . " COMMENT 'Descripción completa de lo que se agrupa en una misma clave presupuestal' ",
            'UNIQUE(clavepresupuestal)',
        ], $tableOptions);

        $this->batchInsert('clavepresupuestal', array('clavepresupuestal', 'descripcion'), array(
            ['Abarrotes Mérida', 'Todo producto cerrado de consumo diario usado principalmente en la cocina'],
            ['Abarrotes Progreso', 'Todo insumo que se compre directamente en progreso'],
            ['Barra Cafe', 'Productos que son utilizados para la atencion a comensales'],
            ['Bienes Electrónicos', 'Todo producto que por su naturaleza de uso requiere luz para funcionar'],
            ['Bienes Muebles', 'Herramientas de trabajo (mesas, ollas, cubiertos, etc)'],
        ));

    }

    public function down()
    {
        echo "m160908_192334_clave_presupuestal cannot be reverted.\n";
        $this->dropTable('clavepresupuestal');

        return false;
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
