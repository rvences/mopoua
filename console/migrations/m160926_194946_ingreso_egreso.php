<?php

use yii\db\Migration;

class m160926_194946_ingreso_egreso extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropColumn('proveedores', 'paga_cajero');
        $this->dropColumn('conteonotas', 'formapago');
        $this->addColumn('arqueo', 'efectivoapertura', $this->money(9,2));
        $this->addColumn('arqueo', 'efectivocierre', $this->money(9,2));
        $this->addColumn('arqueo', 'efectivosistema', $this->money(9,2));
        $this->addColumn('arqueo', 'dineroelectronico', $this->money(9,2));
        $this->addColumn('arqueo', 'efectivoadeudoanterior', $this->money(9,2));
        $this->addColumn('arqueo', 'depositoempresa', $this->money(9,2));
        $this->addColumn('arqueo', 'retiroempresa', $this->money(9,2));
        $this->addColumn('arqueo', 'egresocompras', $this->money(9,2));
        $this->addColumn('arqueo', 'egresocomprasservicio', $this->money(9,2));
        $this->addColumn('arqueo', 'efectivofisico', $this->money(9,2));
        $this->addColumn('arqueo', 'adeudoanterior', $this->money(9,2));
        $this->addColumn('arqueo', 'adeudoactual', $this->money(9,2));
        $this->addColumn('arqueo', 'ventaturno', $this->money(9,2));
        $this->addColumn('arqueo', 'egresoturno', $this->money(9,2));

        $this->addColumn('arqueo', 'cerrado', $this->boolean()->defaultValue(false));


        $this->createTable('{{tipoingresoegreso}}', [
            'id' => $this->primaryKey(),
            'tipo' => $this->string(50)->notNull(),
            'descripcion' => $this->string(100)->notNull(),
            'UNIQUE(descripcion)',
        ], $tableOptions);

        // INGRESO  - ELECTRONICO   - VENTAS CON TARJETA DE CREDITO
        // INGRESO  - EFECTIVO      - VENTAS EN EFECTIVO
        // INGRESO  - ELECTRONICO   - POR NOTAS DE VENTA FIRMADAS
        // INGRESO  - EMPRESA       - AGREGAR FLUJO CIRCULANTE DE EFECTIVO
        // RETIRO   - EMPRESA       - RETIRO DE EXCESO DE EFECTIVO POR SEGURIDAD
        // INGRESO  - ADEUDO        - PAGO ADEUDOS

    }

    public function down()
    {
        echo "Catalogo de Ingreso y Egreso.\n";
        $this->dropColumn('arqueo', 'montoadeudo');
        $this->dropColumn('arqueo', 'montoapertura');
        $this->dropColumn('arqueo', 'montocierre');
        $this->dropColumn('arqueo', 'montoingreso');
        $this->dropColumn('arqueo', 'montoegreso');
        $this->dropColumn('arqueo', 'montoretiro');
        $this->dropColumn('arqueo', 'liquidoadeudo');

        $this->dropTable('tipoingresoegreso');
        $this->dropColumn('arqueo', 'efectivoapertura');
        $this->dropColumn('arqueo', 'efectivocierre');
        $this->dropColumn('arqueo', 'efectivosistema');
        $this->dropColumn('arqueo', 'dineroelectronico');
        $this->dropColumn('arqueo', 'efectivoadeudoanterior');
        $this->dropColumn('arqueo', 'depositoempresa');
        $this->dropColumn('arqueo', 'retiroempresa');
        $this->dropColumn('arqueo', 'egresocompras');
        $this->dropColumn('arqueo', 'egresocomprasservicio');
        $this->dropColumn('arqueo', 'efectivofisico');
        $this->dropColumn('arqueo', 'adeudoanterior');
        $this->dropColumn('arqueo', 'adeudoactual');
        $this->dropColumn('arqueo', 'ventaturno');
        $this->dropColumn('arqueo', 'egresoturno');
        $this->dropColumn('arqueo', 'cerrado');




        $this->addColumn('conteonotas', 'formapago', $this->string(255)->notNull());
        $this->addColumn('proveedores', 'paga_cajero', $this->boolean()->defaultValue(true));

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
