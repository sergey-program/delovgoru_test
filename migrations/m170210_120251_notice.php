<?php

use yii\db\Migration;

class m170210_120251_notice extends Migration
{
    public function safeUp()
    {
        $this->createTable('notice', [
            'id' => 'pk',
            'oncreate' => $this->integer()->unsigned()->notNull(),
            'message' => $this->text()->notNull()
        ]);

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('notice');
        echo "m170210_120251_notice reverted.\n";

        return true;
    }
}
