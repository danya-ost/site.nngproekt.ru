<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AuthItemChild extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }

    public function rules()
    {
        return [
            [['parent'], 'required'],
            [['child'], 'required'],
        ];
    }
}