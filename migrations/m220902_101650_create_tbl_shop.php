<?php

use yii\db\Migration;

/**
 * Class m220902_101650_create_tbl_shop
 */
class m220902_101650_create_tbl_shop extends Migration
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

        $this->createTable('shop', [
            'id' => 'INT(11) PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string(20),
            'address' => $this->string(150),
            'area' => $this->integer(1),
            'phone' => $this->string(10)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
