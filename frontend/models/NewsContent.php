<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NewsContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_content}}';
    }

    public function rules()
    {
        return [
            [['news_id'], 'required'],
            [['title'], 'trim'],
            [['annotation'], 'trim'],
            [['content'], 'trim'],
        ];
    }
}