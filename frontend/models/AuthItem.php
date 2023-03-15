<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AuthItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    public function rules()
    {
        return [
            [['name'], 'trim'],
            [['type'], 'trim'],
            [['description'], 'trim'],
        ];
    }
}