<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class GalleryContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%gallery_content}}';
    }

    public function rules()
    {
        return [
            [['gallery_id'], 'required'],
            [['title'], 'trim'],
            [['cover_src'], 'trim'],
        ];
    }
}