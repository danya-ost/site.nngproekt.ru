<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class BlogComments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%blog_comments}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['blog_id'], 'required'],
            [['comment'], 'trim'],
            [['parent_comment_id'], 'trim'],
            [['status'], 'trim'],
        ];
    }
}