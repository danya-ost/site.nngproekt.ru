<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsPreview extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_preview}}';
    }

    public function rules()
    {
        return [
            [['talents_id'], 'required'],
            [['image_src'], 'trim'],
            [['video_src'], 'trim'],
        ];
    }
}