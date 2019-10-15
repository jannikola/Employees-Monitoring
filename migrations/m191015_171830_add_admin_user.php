<?php

use yii\db\Migration;

/**
 * Class m191015_171830_add_admin_user
 */
class m191015_171830_add_admin_user extends Migration
{

    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'admin',
            'email' => 'admin@employeesmonitoring.com',
            'password_hash' => '$2y$10$GyzMZM8dbAFiSQ1DmyY/reMn5BvDqytXGNIYFDQfjwaE8bcn4oW8K',
            'created_at' => time(),
            'is_deleted' => 0,
        ]);
    }


    public function safeDown()
    {
        echo "m191015_171830_add_admin_user cannot be reverted.\n";

        return false;
    }


}
