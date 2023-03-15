<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AuthAssigment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    public function rules()
    {
        return [
            [['item_name'], 'required'],
            [['user_id'], 'required'],
        ];
    }
}