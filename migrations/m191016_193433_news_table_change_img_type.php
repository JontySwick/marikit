<?php

use yii\db\Migration;

/**
 * Class m191016_193433_news_table_change_img_type
 */
class m191016_193433_news_table_change_img_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191016_193433_news_table_change_img_type cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('{{%news}}', 'img', 'string');
    }

    public function down()
    {
        $this->alterColumn('{{%news}}', 'img', 'integer');
        return false;
    }
}
