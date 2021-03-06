<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('user', array('username', 'auth_key', 'password_hash', 'email', 'status', 'created_at', 'updated_at'), array(
            ['rvences', 'ePGWG40GOH85iAalZxpE17aFrBmyeVkK',
                '$2y$13$L7h/19wYh/.IQs7TgqSP..WU3J3zsKBIcb.gf6hUSEYGTrVP/DUY.', 'rvences@gmail.com', 10, 'now()', 'now()'],
        ));
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
