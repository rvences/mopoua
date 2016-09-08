<?php

use yii\db\Migration;

class m160907_191019_mrp_proveedores extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /**
         * Lead Time (Tiempo de fabricacion), Transit Time, MOQ - Minium Order Quantity,    PP - Precio Promedio, CPE - Costo Por Envio por pieza
         * CREACION DE CATALOGOS PARA EL MODULO MRP  - Materials Requirement Planning
         * Contempla Proveedores -
         *              Tipo de Proveedores ( Servicio, Abarrotes en General, Carnes Frías )
         *              Proveedores (Empresa, Nombre Corto, Razon Social, Contacto, Telefono,
         *                  Proveedor   Contacto    TT      MOQ
         *                  Etrusca     Cristian    5 Días  10 Piezas
         *
         *              Materias Primas
         *                  Tipo        Producto,
         *                  Abarrotes   Leche Entera
         *                  Cristalería Copa de V
         *
         *      PPBA Precio Promedio Bruto Anual
         *      IVA Indica si el producto causa o no IVA
         *      PPBU Precio Promedio Bruto Unitario
         *      FActualizado - Fecha de Ultima modificación
         *      UPC Ultimo precio de compra
         *              Cat. de Presentaciones
         *                  Producto,       Marca,      Modelo  Presentacion,   Contenido   Volumen     Inventariable   UPC Variacion Ant   PPBA     IVA   PPU      FActualizado
         *                  Leche Entera    Alpura              1 CAJA          12 PIEZAS   1 LITRO     Si              162 +5%             163     No    13.58
         *                  Copa de V       Crisa       UT-123  1 CAJA          10 PIEZAS   N/A         Si              162 -1%             250     Si    25
         *
         *  1 CAJA = 12 UNIDADES X
         *
         *
         *              Listado de Producto Solicitado -
         *                  Producto,       Marca,  Cantidad,   Contenido   Volumen     Ultimo Precio   Lugar Ult Compra
         *                  Leche Entera    Alpura  1 CAJA      12 PIEZAS   1 LITRO     163             SAMS
         *
         *              Listado de Producto Comprado -
         *                  Producto,       Marca,  Presentacion,   Contenido   Volumen     Precio Prod F. Caducidad    Proveedor   F. Compra       CPE
         *                  Leche Entera    Alpura  1 CAJA          12 PIEZAS   1 LITRO      163        14 Dic 2015     Sams Club   15 Oct 2015     1.50
         *
         */

        // CREACION DE CATALOGOS

        // DESCRIBE mrp_cat_tipoproveedor;
        // SHOW CREATE TABLE mrp_cat_tipoproveedor;

        /**
         * Este catálogo debe de contener todos los tipos de proveedores que se pueden tener sean para un mismo
         * o diferente tipo de insumo; NO importa si el insumo es inventariable o NO
         * Solo se consideran proveedores de productos NO de Servicios ( se excluye luz, telefono, etc)
         */

        $this->createTable('{{%tipoproveedores}}', [
            'id' => $this->primaryKey(),
            'tipoproveedor' => $this->string(100)->notNull() .  " COMMENT 'Tipo de Proveedor' ",
            'UNIQUE (tipoproveedor)',
        ], $tableOptions
        );

        $this->batchInsert('tipoproveedores', array('tipoproveedor'), array(
            ['ABARROTES EN GENERAL'],
            ['CARNES FRIAS'],
            ['FRUTAS Y VERDURAS'],
        ));

        /**
         * Listado de todos los proveedores que se tienen con una pequeña agenda para poder contactarlos; este
         * puede ir creciendo dependiendo de las necesidades específicas por ejemplo para agregar más teléfonos
         * de contacto, correo, CLABE, etc.
         */

        $this->createTable('{{%proveedores}}', [
            'id' => $this->primaryKey(),
            'nombre_corto' => $this->string(20)->notNull() .    " COMMENT 'Como se conoce al proveedor'",
            'tipoproveedor_id' => $this->integer()->notNull() .  " COMMENT 'Tipo de Proveedor' ",
            'razon_social' => $this->string(100)->notNull() .   " COMMENT 'Nombre del Proveedor' ",
            'contacto' => $this->string(100) .                  " COMMENT 'Vendedor' ",
            'telefono' => $this->string(15) .                   " COMMENT 'Telefono de Contacto'",
            'rfc' => $this->string(13) . " COMMENT 'RFC del Proveedor'",
            'correo' => $this->string(100) . " COMMENT 'Correo del Proveedor'",
            'notas' => $this->text() . " COMMENT 'Temas importantes'",
            'clabe' => $this->string(20) . " COMMENT 'Clave InterBancaria' ",
            'cuenta' =>$this->string(30) . " COMMENT 'Número de Cuenta'",
            'banco' =>$this->string(20) . " COMMENT 'Nombre del Banco'",
            'cliente' =>$this->string(20) . " COMMENT 'Número de Cliente'",



            'UNIQUE KEY (razon_social)',
            'FOREIGN KEY (tipoproveedor_id) REFERENCES {{%tipoproveedores}}(id)
                ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->batchInsert('proveedores', array('nombre_corto', 'tipoproveedor_id', 'razon_social'), array(
            ['ETRUSCA', 1, 'ETRUSCA COMERCIAL'],
            ['SAMS', 1, 'SAMS MERIDA'],
            ['COSTCO', 1, 'COSTCO MERIDA'],
        ));


    }

    public function down()
    {
        echo "m160907_191019_mrp_proveedores No se puede revertir.\n";

        $this->dropTable('proveedores');
        $this->dropTable('tipoproveedores');

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
