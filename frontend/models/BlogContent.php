<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class BlogContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%blog_content}}';
    }

    public function rules()
    {
        return [
            [['blog_id'], 'required'],
            [['title'], 'trim'],
            [['annotation'], 'trim'],
            [['content'], 'trim'],
        ];
    }
}