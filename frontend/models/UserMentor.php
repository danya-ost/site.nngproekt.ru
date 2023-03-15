<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class UserMentor extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_mentor}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id_mentor'], 'trim'],
        ];
    }
}