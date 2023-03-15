<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsFixed extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_fixed}}';
    }

    public function rules()
    {
        return [
            [['talents_id'], 'required'],
            [['status'], 'trim'],
        ];
    }
}