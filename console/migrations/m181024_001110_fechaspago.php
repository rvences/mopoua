<?php

use yii\db\Migration;

/**
 * Class m181024_001110_fechaspago
 */
class m181024_001110_fechaspago extends Migration
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

        $this->createTable('temporalidad_pago', [
            'id' => $this->primaryKey(),
            'temporalidad' => $this->string(20),
            'multiplicador' => $this->decimal(4,2),
        ]);

        $this->batchInsert('temporalidad_pago', array('temporalidad', 'multiplicador'), array(
            ['POR DIA', 1],
            ['POR SEMANA', 7],
            ['POR CATORCENA', 14],
            ['POR QUINCENA', 15.2],
        ));

        // Se deja libre para poder realizar pagos, semanales, quincenales, diarios, etc.
        $this->createTable('fechas_pago',[
            'id' => $this->primaryKey(),
            'de' => $this->date(),
            'hasta' => $this->date(),
            'total_dias' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            // Datos en los que se procesa la nomina
            'fecha_pago' => $this->integer(), // Se obtiene de la fecha exacta en que se procesa la nomina tabla NOMINA
            'temporalidad_pago_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_fechas_pago_user', 'fechas_pago', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_fechas_pago_user2', 'fechas_pago', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_fechas_pago_temporalidad', 'fechas_pago', 'temporalidad_pago_id', 'temporalidad_pago', 'id', 'RESTRICT', 'RESTRICT');

        $this->addColumn('colaboradores', 'activo', $this->boolean());
        $this->addColumn('colaboradores', 'temporalidad_pago_id', $this->integer());
        $this->addForeignKey('FK_colaboradores_temporalidad', 'colaboradores', 'temporalidad_pago_id', 'temporalidad_pago', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('fechas_pago');
        $this->dropTable('temporalidad_pago');
        echo "m181024_001110_fechaspago cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181024_001110_fechaspago cannot be reverted.\n";

        return false;
    }
    */
}
