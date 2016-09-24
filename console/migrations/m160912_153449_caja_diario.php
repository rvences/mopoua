<?php

use yii\db\Migration;

class m160912_153449_caja_diario extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{arqueo}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'farqueo' => $this->dateTime()->defaultValue(null),
            'montoadeudo' => $this->money(9,2),
            'montoapertura' => $this->money(9,2),
            'montocierre' => $this->money(9,2),
            'montoingreso' => $this->money(9,2),
            'montoegreso' => $this->money(9,2),
            'montoretiro' => $this->money(9,2),
            'liquidoadeudo' => $this->boolean()->defaultValue(false),
            'comentario' => $this->text(),
        ], $tableOptions);

        $this->createTable('{{conteonotas}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'fconteo' => $this->dateTime()->defaultValue(null),
            'tipo' => $this->string(255)->notNull(),
            'descripcion' => $this->text(),
            'cantidad' => $this->money(9,2),
            'formapago' => $this->string(255)->notNull(),
            'arqueo_id' => $this->integer(),
            'FOREIGN KEY (arqueo_id) REFERENCES {{%arqueo}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);



        // Modificar Listado de Proveedores para indicar los que surten directamente en la Cafeteria y sean los que se utilicen en caja diario




        $this->createTable('{{conteodiario}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'inal1' => $this->integer(),
            'inal2' => $this->integer(),
            'inal3' => $this->integer(),
            'inal4' => $this->integer(),
            'inal5' => $this->integer(),
            'inal6' => $this->integer(),
            'inal7' => $this->integer(),
            'inal8' => $this->integer(),
            'inal9' => $this->integer(),
            'inal10' => $this->integer(),
            'inal11' => $this->integer(),
            'inal12' => $this->integer(),
            'inal13' => $this->integer(),
            'inal14' => $this->integer(),
            'inal15' => $this->integer(),
            'inal16' => $this->integer(),
            'iext1' => $this->integer(),
            'iext2' => $this->integer(),
            'fapertura' => $this->dateTime()->defaultValue(null),
            'cnal1' => $this->integer(),
            'cnal2' => $this->integer(),
            'cnal3' => $this->integer(),
            'cnal4' => $this->integer(),
            'cnal5' => $this->integer(),
            'cnal6' => $this->integer(),
            'cnal7' => $this->integer(),
            'cnal8' => $this->integer(),
            'cnal9' => $this->integer(),
            'cnal10' => $this->integer(),
            'cnal11' => $this->integer(),
            'cnal12' => $this->integer(),
            'cnal13' => $this->integer(),
            'cnal14' => $this->integer(),
            'cnal15' => $this->integer(),
            'cnal16' => $this->integer(),
            'cext1' => $this->integer(),
            'cext2' => $this->integer(),
            'fcierre' => $this->dateTime()->defaultValue(null),
            'montoapertura' => $this->money(9,2),
            'montocierre' => $this->money(9,2),
            'arqueo_id' => $this->integer(),
            'FOREIGN KEY (arqueo_id) REFERENCES {{%arqueo}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createIndex('idx_conteodiario', 'conteodiario', 'username, arqueo_id');



    }

    public function down()
    {
        echo "Caja Diario no se puede revertir.\n";

        $this->dropTable('conteonotas');
        $this->dropTable('conteodiario');
        $this->dropTable('arqueo');

        return true;
    }
}
