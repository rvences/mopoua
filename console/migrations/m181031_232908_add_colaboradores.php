<?php

use yii\db\Migration;

/**
 * Class m181031_232908_add_colaboradores
 */
class m181031_232908_add_colaboradores extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('colaboradores', 'telefono', $this->string(10));
        $this->addColumn('colaboradores', 'emergencia_contacto', $this->string(100));
        $this->addColumn('colaboradores', 'emergencia_telefono', $this->string(10));
        $this->addColumn('colaboradores', 'forma_pago', $this->string(10));
        $this->addColumn('colaboradores', 'numero_cuenta', $this->string(18));
        $this->addColumn('colaboradores', 'observaciones', $this->text());

        $this->addColumn('nomina', 'numero_cuenta', $this->string(18));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181031_232908_add_colaboradores cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181031_232908_add_colaboradores cannot be reverted.\n";

        return false;
    }
    */
}
