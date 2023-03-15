<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NewsLiked extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_likes}}';
    }

    public function rules()
    {
        return [
            [['news_id'], 'required'],
            [['user_id'], 'required'],
            [['status'], 'trim'],
        ];
    }
}