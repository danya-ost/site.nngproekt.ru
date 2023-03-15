<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class InitiativeSupportive extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%initiative_supportive}}';
    }

    public function rules()
    {
        return [
            [['initiative_id'], 'required'],
            [['user_id'], 'required'],
        ];
    }
}