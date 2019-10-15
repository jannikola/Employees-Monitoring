<?php

use yii\db\Migration;

/**
 * Class m191015_170608_add_initial_structure
 */
class m191015_170608_add_initial_structure extends Migration
{

    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->integer()->defaultValue(0),
        ]);

        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->integer()->defaultValue(0),
        ]);

        $this->createTable('arrival', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(),
            'date' => $this->integer(),
            'time' => $this->integer(),
            'is_late' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'is_deleted' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey('fk_arrival_employee', 'arrival', 'employee_id', 'employee', 'id');
    }


    public function safeDown()
    {
        $this->dropForeignKey('fk_arrival_employee', 'arrival');

        $this->dropTable('arrival');
        $this->dropTable('employee');
        $this->dropTable('user');

    }


}
