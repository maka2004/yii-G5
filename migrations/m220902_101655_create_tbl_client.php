<?php

use yii\db\Migration;

/**
 * Class m220901_150549_create_tbl_client
 */
class m220902_101655_create_tbl_client extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%client}}', [
            'id' => 'INT(11) PRIMARY KEY AUTO_INCREMENT',
            'first_name' => $this->string(20)->notNull(),
            'last_name' => $this->string(20)->notNull(),
            'middle_name' => $this->string(20),
            'date_of_birth' => $this->integer(11)->notNull(),
            'pin' => $this->integer(11)->notNull(),
            'sex' => $this->tinyInteger(1)->notNull(),
            'email' => $this->string(150),
            'shop_id' => $this->integer(11)->notNull()
        ]);

        $this->addForeignKey(
            'fk-shop-id',
            'client',
            'shop_id',
            'shop',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-client-pin','{{%client}}','pin');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-client-pin', '{{%client}}');

        $this->dropForeignKey('fk-shop-id','{{%client}}');

        $this->dropTable('{{%client}}');
    }
}
