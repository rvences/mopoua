<?php

use yii\db\Migration;

class m160909_145051_unidadmedida extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{unidadmedida}}', [
            'id' => $this->primaryKey(),
            'unidad' => $this->string(6)->notNull(),
            'descripcion' =>$this->string(30)->notNull() . " COMMENT 'Descripcion de la medida' ",
            'tipo_unidad' => $this->string(20)->notNull() . " COMMENT 'Tipo de Medida' ",
            'UNIQUE (descripcion)',
            'UNIQUE KEY (unidad)',
        ], $tableOptions);

        $this->batchInsert('unidadmedida', array('unidad', 'descripcion', 'tipo_unidad'), array(
            ['tsp', 'teaspoon o cuchara de café', 'VOLUMEN'],
            ['tbsp', 'tablespoon o cuchara de mesa', 'VOLUMEN'],
            ['taza', 'taza o cup', 'VOLUMEN'],
            ['fl oz', 'onza líquida', 'VOLUMEN'],
            ['ml', 'mililitro', 'VOLUMEN'],
            ['lt', 'litro', 'VOLUMEN'],
            ['oz', 'onza', 'PESO'],
            ['lb', 'pound o libra', 'PESO'],
            ['gr', 'gramo', 'PESO'],
            ['kg', 'kilogramo', 'PESO'],
            ['ºC', 'Grado Centígrado', 'TEMPERATURA'],
            ['ºF', 'Grado Farenheit', 'TEMPERATURA'],
            ['pz', 'Pieza', 'CANTIDAD'],
            ['sv', 'Servicio', 'CANTIDAD'],
            ['na', 'Sin Unidad', 'CANTIDAD'],
        ));

    }

    public function down()
    {
        echo "m160909_145051_unidadmedida cannot be reverted.\n";
        $this->dropTable('unidadmedida');

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
