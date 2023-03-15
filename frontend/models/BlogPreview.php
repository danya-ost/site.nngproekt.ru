<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class BlogPreview extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%blog_preview}}';
    }

    public function rules()
    {
        return [
            [['blog_id'], 'required'],
            [['image_src'], 'trim'],
            [['video_src'], 'trim'],
        ];
    }
}