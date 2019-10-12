<?php

use yii\db\Migration;

/**
 * Class m191012_164822_change_index_news_table
 */
class m191012_164822_change_index_news_table extends Migration
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
        echo "m191012_164822_change_index_news_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropIndex(
            'news_xml_index',
            '{{%news}}'
        );

        $this->createIndex(
            'news_xml_index',
            '{{%news}}',
            'xml_id',
            true
        );
    }

    public function down()
    {
        $this->dropIndex(
            'news_xml_index',
            '{{%news}}'
        );

        $this->createIndex(
            'news_xml_index',
            '{{%news}}',
            'xml_id'
        );
    }
}
