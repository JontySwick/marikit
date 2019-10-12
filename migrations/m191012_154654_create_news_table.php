<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m191012_154654_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'xml_id' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'preview_text' => $this->string()->notNull(),
            'detail_text' => $this->text()->notNull(),
            'img' => $this->integer(),
        ]);

        $this->createIndex(
            'news_xml_index',
            '{{%news}}',
            'xml_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
