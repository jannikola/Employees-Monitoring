<?php

use yii\db\Migration;

/**
 * Class m191016_082728_update_column_types_on_arrivals
 */
class m191016_082728_update_column_types_on_arrivals extends Migration
{

    public function safeUp()
    {
        $this->alterColumn('arrival', 'date', $this->date());
        $this->alterColumn('arrival', 'time', $this->time());
    }


    public function safeDown()
    {
        $this->alterColumn('arrival', 'time', $this->integer());
        $this->alterColumn('arrival', 'date', $this->integer());
    }


}
