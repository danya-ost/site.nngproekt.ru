<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer}}';
    }

    public function rules()
    {
        return [
            [['name'], 'trim'],
            [['address'], 'trim'],
        ];
    }
}