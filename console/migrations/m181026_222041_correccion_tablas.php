<?php

use yii\db\Migration;

/**
 * Class m181026_222041_correccion_tablas
 */
class m181026_222041_correccion_tablas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('movimiento_diario', 'motivo');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181026_222041_correccion_tablas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181026_222041_correccion_tablas cannot be reverted.\n";

        return false;
    }
    */
}
