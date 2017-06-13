<?php

use yii\db\Migration;

class m170603_122145_modulo_tareas extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /***************** CATALOGOS PARA PRODUCTIVIDAD ***********************/

        $this->createTable('prodcatalogos', [
            'id'=> $this->primaryKey(),
            'campo' => $this->string('20')->notNull(),
            'descripcion' => $this->string('40')->notNull(),
            'activo' => $this->boolean()->defaultValue(1)->notNull(),
        ], $tableOptions);
        $this->createIndex('uk_prodcatalogos', 'prodcatalogos', ['campo', 'descripcion'], true);

        $this->batchInsert('prodcatalogos',
            array('campo', 'descripcion'),
            array(
                [ 'estado', 'Realizado'],
                [ 'estado', 'Planeado'],
                [ 'tipoactividad', 'Personal'],
                [ 'tipoactividad', 'Limpieza Programada'],
                [ 'tipoactividad', 'Pre Producción'],
                [ 'tipoactividad', 'Mantenimiento Preventivo'],
                [ 'tipoactividad', 'Reparación'],
                [ 'tipoactividad', 'Otra'],
            ));

        /***************** USER (alteracion) ***********************/
        $this->addColumn('user', 'area', $this->string(20)); // Poder separar por area laboral ej. comedor, cocina, administracion, etc.


        /***************** TAREAS ***********************/

        $this->createTable('tareas', [
            'id' => $this->primaryKey(),
            'asignado_id' => $this->integer()->notNull(),  // Usuario responsable de la tarea --- Rafael
            'tipoactividad_id' => $this->integer()->notNull(), // Tipo de Actividad
            'estado_id' => $this->integer()->notNull(), // Planeado, Realizado, Postergado
            'tarea' => $this->string()->notNull(),
            'resultado' => $this->string(), // En caso de requerir resultado, poder escribirlo.
            'fecha_limite' => $this->date()->notNull(), // Por defecto mismo día de su solicitud


            // Estadistico para el sistema
            'user_solicita_id' => $this->integer()->notNull(),  // Usuario registrado en el sistema
            'modified' => $this->dateTime(),
            'created' => $this->dateTime(),
            'user_realizo_id' => $this->integer(), // Es el logeado en el sistema al guardar la informacion

            ], $tableOptions);
        $this->addForeignKey('fk_tareas5_2_user', 'tareas', 'asignado_id', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_tareas0_2_user', 'tareas', 'user_solicita_id', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_tareas1_2_user', 'tareas', 'user_realizo_id', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_tareas4_2_prodcatalogos', 'tareas', 'estado_id', 'prodcatalogos', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_tareas5_2_prodcatalogos', 'tareas', 'tipoactividad_id', 'prodcatalogos', 'id', 'RESTRICT', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('tareas');
        $this->dropTable('prodcatalogos');
        $this->dropColumn('user','area');
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
