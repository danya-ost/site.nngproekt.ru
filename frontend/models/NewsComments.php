<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NewsComments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_comments}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['news_id'], 'required'],
            [['comment'], 'trim'],
            [['parent_comment_id'], 'trim'],
            [['status'], 'trim'],
        ];
    }
}