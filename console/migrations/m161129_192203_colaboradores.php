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



        $this->createTable('{{%colaboradores}}', [
            'id' => $this->primaryKey(),
            'clave' => $this->string(10)->notNull() . " COMMENT 'Clave del Colaborador'",
            'nombre' => $this->string(100)->notNull() .  " COMMENT 'Nombre(s)' ",
            'apaterno' => $this->string(32)->notNull() .  " COMMENT 'Ap. Paterno' ",
            'amaterno' => $this->string(32)->notNull() .  " COMMENT 'Ap. Materno' ",
            'rfc' => $this->string(13)->defaultValue(null) .  " COMMENT 'RFC' ",
            'curp' => $this->string(18)->defaultValue(null) .  " COMMENT 'CURP' ",
            'nss' => $this->string(11)->defaultValue(null) .  " COMMENT 'Número Seguro Social' ",
            'puesto' => $this->integer() . " COMMENT 'Identificador del puesto'",
            'tipo' => $this->string(11) .  " COMMENT 'Tipo' ", // Si el puesto es eventual, fijo o de que tipo
            'tabulador' => $this->integer() . " COMMENT 'Tabulador'", // Nivel del colaborador para pago
            'fingreso' => $this->dateTime()->defaultValue(null) .  " COMMENT 'Fecha Ingreso' ",
            'fbaja' => $this->dateTime()->defaultValue(null) .  " COMMENT 'Fecha Baja' ",
            'UNIQUE (clave)',
            'UNIQUE (rfc)',
        ], $tableOptions
        );

        $this->createTable('{{%colaboradores_pago}}', [
            'id' => $this->primaryKey(),
            'colaboradores_id' => $this->integer()->notNull() . " COMMENT 'ID del Colaborador'", // Automatico
            'quincena' => $this->integer()->notNull() . " COMMENT 'ID de la Quincena'", // Automatico
            'anio' => $this->integer()->notNull() . " COMMENT 'ID del Año del Pago'", // Automatico
            'periodo_pago' => $this->string(100)->notNull() . " COMMENT 'Periodo del pago'", // Automatico
            'clave_percepcion' => $this->integer()->notNull() . " COMMENT 'Clave del Ingreso'", // Automatico
            'monto_percepcion' => $this->money(9,2) . "COMMENT 'Monto del ingreso' ",
            'clave_deduccion' => $this->integer()->notNull() . " COMMENT 'Clave del Egreso' ", // Automatico
            'monto_deduccion' => $this->money(9,2)->notNull() . " COMMENT 'Monto del Egreso' ",
        ], $tableOptions
        );

        $this->createTable('{{%asistencia}}', [
            'id' => $this->primaryKey(),
            'clave' => $this->integer()->notNull() . " COMMENT 'Clave del Usuario'", // Automatico
            'entrada' => $this->dateTime()->defaultValue(null) . " COMMENT 'Fecha y Hora de Entrada'", // Automatico
            'salida' => $this->dateTime()->defaultValue(null) . " COMMENT 'Fecha y Hora de Entrada'", // Automatico
            'justificacion' => $this->string(150)->notNull() . " COMMENT 'Justificacion de mal registro'",
            'estado' => $this->string('15') . " COMMENT 'Estado de la Asistencia'", // NORMAL, FALTA, RETARDO, JUSTIFICADO, DOBLE

        ], $tableOptions
        );

        $this->createTable('{{%percepcion_deduccion}}', [
            'id' => $this->primaryKey(),
            'id_monto' => $this->string(100)->notNull() .  " COMMENT 'ID del concepto de pago' ",
            'tipo' => $this->string(10)->notNull() . " COMMENT 'Percepcion o Deduccion'",
            'concepto' => $this->string(100)->notNull() . " COMMENT 'Concepto'",
            'UNIQUE (id_monto)',
        ], $tableOptions
        );

        $this->batchInsert('percepcion_deduccion', array('id_monto', 'tipo', 'concepto'), array(
            ['P1', 'PERCEPCION', 'Sueldo Base'],
            ['P2', 'PERCEPCION', 'Compensación Garantizada'],
            ['P3', 'PERCEPCION', 'Ayuda de Alimentos'],
            ['P4', 'PERCEPCION', 'Laborado Día Inhabil'],
            ['P5', 'PERCEPCION', 'Turno Laborado Adicional'],

            ['D1', 'DEDUCCION', 'ISR Por la Empresa'],
            ['D2', 'DEDUCCION', 'ISR Por el Colaborador'],
            ['D3', 'DEDUCCION', 'Préstamos Personales'],
            ['D4', 'DEDUCCION', 'Faltas Injustificadas'],
            ['D5', 'DEDUCCION', 'Retardos Injustificados'],
        ));
    }

    public function down()
    {
        echo "m161129_192203_colaboradores cannot be reverted.\n";

        $this->dropTable('percepcion_deduccion');
        $this->dropTable('asistencia');
        $this->dropTable('colaboradores_pago');
        $this->dropTable('colaboradores');

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
