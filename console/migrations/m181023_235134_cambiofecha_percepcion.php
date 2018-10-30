<?php

use yii\db\Migration;

/**
 * Class m181023_235134_cambiofecha_percepcion
 */
class m181023_235134_cambiofecha_percepcion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('nompercepciondeduccion', 'created');
        $this->dropColumn('nompercepciondeduccion', 'updated');
        $this->addColumn('nompercepciondeduccion', 'created_by', $this->integer());
        $this->addColumn('nompercepciondeduccion', 'created_at', $this->integer());
        $this->addColumn('nompercepciondeduccion', 'updated_by', $this->integer());
        $this->addColumn('nompercepciondeduccion', 'updated_at', $this->integer());
        $this->addForeignKey('FK_nompercepciondeduccion_user', 'nompercepciondeduccion', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_nompercepciondeduccion_user2', 'nompercepciondeduccion', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181023_235134_cambiofecha_percepcion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181023_235134_cambiofecha_percepcion cannot be reverted.\n";

        return false;
    }
    */
}
