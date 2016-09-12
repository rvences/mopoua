<?php

use yii\db\Migration;

class m160910_011327_insumos extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // GENERICO
        // CLAVE: HARINAS Y POLVOS          SUBC: AA1   NOMBREGEN: HARINA DE TRIGO         UNIDAD MEDIDA: GR
        // CLAVE: HARINAS Y POLVOS          SUBC: AA3   NOMBREGEN: GALLETAS OREO           UNIDAD MEDIDA: PIEZA ( GALLETA )
        // CLAVE: REFRESCOS                 SUBC: AA2   NOMBREGEN: COCA COLA PET 355 ML    UNIDAD MEDIDA: PZ

        // PRESENTACIONES
        // SUBC: AA1    CLAVE: PRES001   NOMBRE: HARINA DE TRIGO    MARCA: GREAT VALUE  PRESENTACION: 1 KG          EQUIV: 1000 GR
        // SUBC: AA1    CLAVE: PRES002   NOMBRE: HARINA DE TRIGO    MARCA: SELECTA      PRESENTACION: 1 KG          EQUIV: 1000 GR
        // SUBC: AA2    CLAVE: PRES003   NOMBRE: SPRITE PET 355 ML  MARCA: COCA COLA    PRESENTACION: 1 BOTELLA     EQUIV: 1 PZ
        // SUBC: AA3    CLAVE: PRES004   NOMBRE: GALLETAS OREO      MARCA: NABISCO      PRESENTACION: 8 ROLLOS      EQUIV: 15 PIEZAS
        //                                       JARABE SABOR FRESA MARCA: ROUTIN       PRESENTACION: 1 BOTELLA     EQUIV: 30 OZ

        // BODEGA
        // CLAVE: PRES002   2 PAQUETE CON  4  PIEZA     TOTAL 4 KG
        // CLAVE: PRES002                  1  PIEZA     TOTAL 1 KG
        // CLAVE: PRES003   1 CAJA CON    24 PIEZAS   =  TOTAL 24 PET 355 ML
        // CLAVE: PRES004   2 CAJA CON    8  ROLLOS   =  TOTAL 16 ROLLOS


        // INVENTARIO
        // CLAVE: PRES003   NOMBRE: SPRITE PET 355 ML       CANTIDAD    24 PZ
        // CLAVE: PRES004   NOMBRE: GALLETAS OREO (ROLLOS)  CANTIDAD    16 ROLLOS

        // EN PROCESO - PRODUCTO ABIERTO
        // CLAVE: PRES002   HARINA DE TRIGO SELECTA 1 KG    455 GR
        // CLAVE: PRES004   GALLETAS OREO (ROLLOS)          14 PIEZA ( GALLETA)
        $this->createTable('{{insumo}}', [
            'id' => $this->primaryKey(),
            'clavepresupuestal_id' => $this->integer()->notNull(),
            'insumo_generico' => $this->string(100)->notNull(),
            'unidad_id' => $this->integer()->notNull(),
            'FOREIGN KEY (clavepresupuestal_id) REFERENCES {{%clavepresupuestal}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (unidad_id) REFERENCES {{%unidadmedida}}(id) ON DELETE RESTRICT ON UPDATE CASCADE',
            'UNIQUE KEY (clavepresupuestal_id, insumo_generico)',
        ], $tableOptions);

        $this->createTable('{{presentacion}}', [
            'id' => $this->primaryKey(),
            'insumo_id' => $this->integer()->notNull(),
            'insumo' => $this->string(100)->notNull(),
            'marca' => $this->string(100)->notNull(),

            'presentacion' => $this->integer()->notNull(),
            'presentacionunidad_id' => $this->integer()->notNull(),

            'equivalencia' => $this->integer()->notNull(),
            'equivalenciasunidad_id' => $this->integer()->notNull(),

            'FOREIGN KEY (insumo_id) REFERENCES {{%insumo}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (presentacionunidad_id) REFERENCES {{%unidadmedida}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (equivalenciasunidad_id) REFERENCES {{%unidadmedida}}(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'UNIQUE KEY(insumo_id, insumo, marca, presentacion)',
        ], $tableOptions);

    }

    public function down()
    {
        echo "m160910_011327_insumos cannot be reverted.\n";
        $this->dropTable('presentacion');
        $this->dropTable('insumo');

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
