<?php

use yii\db\Migration;

/**
 * Class m181029_165711_procesa_nomina_status
 */
class m181029_165711_procesa_nomina_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // estado_proceso
        //  0   Sin Procesar
        //  1   Solicitado  --  Lo solicita el usuario y se bloquea para edición
        //  2   En Proceso  --  Se inicia el proceso en el CRON
        //  9   Procesado   --  CRON finalizado


        $this->addColumn('fechas_pago', 'estado_proceso', $this->integer()->notNull()->defaultValue(0));

        $this->addColumn('nomina_glosa', 'created_at', $this->integer()->notNull());
        $this->addColumn('nomina_glosa', 'verificador', $this->string(3));
        $this->addColumn('nomina_glosa', 'fechas_pago_id', $this->integer()->notNull());
        $this->addColumn('nomina_glosa', 'concepto', $this->string(100));

        $this->addForeignKey('FK_nomina_glosa_fecha_pago', 'nomina_glosa', 'fechas_pago_id', 'fechas_pago', 'id', 'RESTRICT', 'RESTRICT');


        $this->addColumn('movimiento_diario', 'updated_at', $this->integer());
        $this->addColumn('movimiento_diario', 'updated_by', $this->integer());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropColumn('fechas_pago', 'estado_proceso');
        //echo "m181029_165711_procesa_nomina_status cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_165711_procesa_nomina_status cannot be reverted.\n";

        return false;
    }
    */
}
