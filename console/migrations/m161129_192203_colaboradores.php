<?php

use yii\db\Migration;

class m161129_192203_colaboradores extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%catpuestos}}', [
            'id' => $this->primaryKey(),
            'puesto' => $this->string(50)->notNull() . " COMMENT 'Puesto'", // Es la clave del Biométrico
            'requisitos' => $this->text() .  " COMMENT 'Requisitos del Puesto' ",
            'funciones' => $this->text() .  " COMMENT 'Funciones a Realizar' ",
            'habilidades' => $this->text() .  " COMMENT 'Habilidades a Mostrar' ",
            'conocimientos' => $this->text() .  " COMMENT 'Conocimientos' ",
            'tipo_colaborador' => $this->string(20)->notNull() . " COMMENT 'Tipo de Colaborador'", // Eventual, Base, Temporada
            'plazas' => $this->integer()->notNull() . " COMMENT 'Puestos disponibles'", // Cantidad de puestos disponibles

            'UNIQUE (puesto, tipo_colaborador)',
        ], $tableOptions
        );

        $this->createTable('{{%cattipopd}}', [ // Los montos aqui expresados son mensuales
            'id' => $this->primaryKey(),
            'clave' => $this->string(10), // Clave del tipo de percepcion o deduccion
            'concepto' => $this->string()->notNull() . " COMMENT 'Concepto del pago'", // Sueldo, bono, imss, etc.
            'tipo' => $this->string(20) .  " COMMENT 'Percepción o Deducción' ",  // Indica si es una Percepción (+) o Deducción (-)
            'descripcion' => $this->text() . " COMMENT ' Descripción completa del tipo de Concepto'",
            'UNIQUE (id, concepto)',
            'UNIQUE (clave)',

        ], $tableOptions
        );

        $this->createTable('{{%nompercepciondeduccion}}', [
            'id' => $this->primaryKey(),
            'puesto_id' => $this->integer(),
            'clave_tipopd' => $this->string(10),
            'monto' => $this->decimal(7,2),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),

            'FOREIGN KEY (puesto_id) REFERENCES {{%catpuestos}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (clave_tipopd) REFERENCES {{%cattipopd}}(clave) ON DELETE CASCADE ON UPDATE CASCADE',


        ], $tableOptions

        );


        $this->createTable('{{%colaboradores}}', [
            'id' => $this->primaryKey(),
            'clave' => $this->string(10)->notNull() . " COMMENT 'Clave del Colaborador'", // Es la clave del Biométrico
            'nombre' => $this->string(100)->notNull() .  " COMMENT 'Nombre(s)' ",
            'apaterno' => $this->string(32)->notNull() .  " COMMENT 'Ap. Paterno' ",
            'amaterno' => $this->string(32)->notNull() .  " COMMENT 'Ap. Materno' ",
            'rfc' => $this->string(13)->defaultValue(null) .  " COMMENT 'RFC' ",
            'curp' => $this->string(18)->defaultValue(null) .  " COMMENT 'CURP' ",
            'nss' => $this->string(11)->defaultValue(null) .  " COMMENT 'Número Seguro Social' ",
            'puesto_id' => $this->integer() . " COMMENT 'Identificador del puesto'",
            'fingreso' => $this->dateTime()->defaultValue(null) .  " COMMENT 'Fecha Ingreso' ",
            'fbaja' => $this->dateTime()->defaultValue(null) .  " COMMENT 'Fecha Baja' ",
            'UNIQUE (clave)',
            'UNIQUE (rfc)',
            'FOREIGN KEY (puesto_id) REFERENCES {{%catpuestos}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions
        );

    }

    public function down()
    {

        echo "m161129_192203_colaboradores cannot be reverted.\n";
        $this->dropTable('colaboradores');
        $this->dropTable('nompercepciondeduccion');
        $this->dropTable('catpuestos');
        $this->dropTable('cattipopd');


        //$this->dropTable('percepcion_deduccion');
        /*
        $this->dropTable('asistencia');
        $this->dropTable('colaboradores_pago');

*/
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
