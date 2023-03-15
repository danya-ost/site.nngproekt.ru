<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NewsPreview extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_preview}}';
    }

    public function rules()
    {
        return [
            [['news_id'], 'required'],
            [['image_src'], 'trim'],
            [['video_src'], 'trim'],
        ];
    }
}