<?php

use yii\db\Migration;

/**
 * Class m191020_001348_update_table_colations
 */
class m191020_001348_update_table_colations extends Migration
{
    public function safeUp()
    {
        $db = Yii::$app->getDb();

        $schema = $db->createCommand('select database()')->queryScalar();

        $tables = $db->createCommand('
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema=:schema AND table_type = "BASE TABLE"',
            [':schema' => $schema]
        )->queryAll();

        $db->createCommand('SET FOREIGN_KEY_CHECKS=0;')->execute();

        foreach ($tables as $table) {
            $tableName = $table['table_name'];
            $db->createCommand("
                ALTER TABLE `$tableName` 
                CONVERT TO CHARACTER SET utf8 
                COLLATE utf8_unicode_ci
            ")->execute();
        }
        $db->createCommand('SET FOREIGN_KEY_CHECKS=1;')->execute();
    }

    public function safeDown()
    {
        echo "m191020_001348_update_table_colations cannot be reverted.\n";

        return false;
    }

}
