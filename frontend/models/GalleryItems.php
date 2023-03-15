<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class GalleryItems extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%gallery_items}}';
    }

    public function rules()
    {
        return [
            [['gallery_id'], 'required'],
            [['src'], 'trim'],
            [['user_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}