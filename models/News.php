<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $xml_id
 * @property string $name
 * @property string $preview_text
 * @property string $detail_text
 * @property int $img
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'preview_text', 'detail_text'], 'required'],
            [['detail_text', 'img'], 'string'],
            //[['img'], 'integer'],
            [['name', 'preview_text', 'xml_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xml_id' => 'xml_id',
            'name' => 'Name',
            'preview_text' => 'Preview Text',
            'detail_text' => 'Detail Text',
            'img' => 'Img',
        ];
    }
}
