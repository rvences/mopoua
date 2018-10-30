<?php

use yii\db\Migration;

/**
 * Class m181024_214459_movimiento_diario
 */
class m181024_214459_movimiento_diario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Solo es para faltas, retardos y turnos dobles ( lo indica el biométrico)
        $this->createTable('cat_movimientos_nomina', [
            'id' => $this->primaryKey(),
            'clave' => $this->string(2),
            'movimiento' => $this->string(100),
            'descripcion' => $this->string(100),

        ]);

        //
        //    PK - Prestaciones
        //    DE - Deducciones
        //    PE - Percepciones
        //    CR - Créditos
        //
        $this->batchInsert('cat_movimientos_nomina',
            array('clave', 'movimiento', 'descripcion'),
            array(
                ['PK', 'AGUINALDO', 'El equivalente a 15 días laborados al año'],
                ['PK', 'DIA DE VACACIONES', 'Se paga como día laborado'],

                ['DE', 'ANTICIPO DE QUINCENA', 'Anticipo de hasta el 60% de lo laborado'],
                ['DE', 'DIA NO LABORADO', 'No se paga, se utiliza cuando entran a media quincena'],
                ['DE', 'SUSPENSION TEMPORAL', 'No se pagan los dias que se suspende'],
                ['DE', 'INASISTENCIA JUSTIFICADA', 'No se paga el día que falto'],
                ['DE', 'INASISTENCIA NO JUSTIFICADA', 'Se descuenta doble'],

                ['CR', 'CUENTAS FIRMADAS', 'Saldar las cuentas a fin de mes'],
                ['CR', 'PRESTAMO CON INTERES CON EXTERNO', 'Préstamo externo que se liquidará parcialmente cada quincena'],
                ['CR', 'PRESTAMO SIN INTERES DEL RESTAURANT', 'Préstamo que se liquidará parcialmente cada quincena'],
                ['CR', 'FALTANTES CAJA', 'Dinero faltante en caja chica'],

                ['PE', 'LABORO DIA DE DESCANSO', 'Se le paga doble su salario'],
                ['PE', 'MEDIO TURNO', 'Se paga medio turno a partir de 30 minutos de retardo'],
                ['PE', 'MEDIO TURNO DOBLE', 'Se paga como turno normal'],

                )
        );

        // Aqui se indica cualquier incidente del colaborador para pagar adicionales o descontar de su salario

        // Ejemplo:
        //    RAFAEL VENCES(colaborador_id)  EL DIA  12 FEB 2018(movimiento_fecha) SE ENCUENTRA SUSPENDIDO Y SE TIENE QUE DESCONTAR(movimiento_nomina_id) 220(monto) YA SE DESCONTO(aplicado_en_nomina) EN LA NOMINA DEL 15 FEBRERO 2018(id_nomina_diario)

        $this->createTable('movimiento_diario', [
            'id' => $this->primaryKey(),
            'colaborador_id' => $this->integer(),
            'movimiento_fecha' => $this->date(),
            'movimiento_nomina_id' => $this->integer(),
            'movimiento_nomina_info' => $this->string(100),
            'monto' => $this->decimal(7,2),
            'motivo' => $this->string(255), // Explicar el motivo del movimiento en caso de ser necesario
            'aplicado_en_nomina' => $this->boolean()->defaultValue('0')->notNull(),
            'nomina_glosa_id' => $this->integer(), // Indicar el ID de la nomina en la que se aplicó

            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
        $this->addForeignKey('FK_movimiento_diario_colaboradores', 'movimiento_diario', 'colaborador_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_movimiento_diario2_colaboradores', 'movimiento_diario', 'colaborador_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');


        // Esta tabla se llena a través de un CRON - NO lo hace un usuario del sistema

        $this->createTable('nomina_glosa', [
            'id' => $this->primaryKey(),
            'colaborador_id' => $this->integer(),
            'puesto_id' => $this->integer(),
            'tipo_movimiento' => $this->string(10), // PUESTO (tabla nompercepciondeduccion) - PERSONA (tabla cat_movimientos_nomina)
            'percepcion' => $this->decimal(7,2),
            'deduccion' => $this->decimal(7,2),
            'pk' => $this->decimal(7,2),
            'creditos' => $this->decimal(7,2),
        ]);

        $this->addForeignKey('FK_nomina_glosa_colaboradores', 'nomina_glosa', 'colaborador_id', 'colaboradores', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_movimiento_diario_nomina_glosa', 'movimiento_diario', 'nomina_glosa_id', 'nomina_glosa', 'id', 'RESTRICT', 'RESTRICT');



        // Esta tabla la hace un CRON, no la llena un usuario del sistema
        $this->createTable('nomina', [
            'id' => $this->primaryKey(),
            'fecha_pago_id' => $this->integer(),
            'salario_neto' => $this->decimal(7,2),
            'colaborador_id' => $this->decimal(),
            'colaborador' => $this->string(200),
            'puesto_id' => $this->integer(),
            'puesto' => $this->string(50),
            'forma_pago' => $this->string(10),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),


        ]);
/*
    Nomina Desglosado
        ID COLABOADOR
        NOMBRE COLABORADOR
        INDICAR TIPO DEDUCCION O PERCEPCION
        ID FECHA DE NOMINA PAGADA
        FECHA EN QUE SE APLICARON LOS MOVIMIENTOS

            SUELDO ORDINARIO (Lo calcula el sistema)
            MOVIMIENTO NOMINA MANUAL ( Se lee de tabla)
            IMSS - ISR (Se calcula )
            RENUNCIA - DESPIDO ( Se calcula)


    Nomina
    Salario Bruto  = Percepciones - Deducciones

    Deducciones
        IMSS
        Préstamo - Anticipos
        Inasistencias

    Percepciones
        Sueldo Ordinario
        Bonos
        Dias Dobles
        Vacaciones

 */

        $this->addForeignKey('FK_movimiento_diario_user', 'movimiento_diario', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('FK_movimiento_diario_nomina', 'movimiento_diario', 'movimiento_nomina_id', 'cat_movimientos_nomina', 'id', 'RESTRICT', 'RESTRICT');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nomina');
        $this->dropTable('nomina_glosa');
        $this->dropTable('movimiento_diario');
        $this->dropTable('cat_movimientos_nomina');
        echo "m181024_214459_movimiento_diario cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181024_214459_movimiento_diario cannot be reverted.\n";

        return false;
    }
    */
}
