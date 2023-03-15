<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsLiked extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_likes}}';
    }

    public function rules()
    {
        return [
            [['talents_id'], 'required'],
            [['user_id'], 'required'],
            [['status'], 'trim'],
        ];
    }
}