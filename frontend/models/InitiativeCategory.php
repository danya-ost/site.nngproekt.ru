<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class InitiativeCategory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%initiative_category}}';
    }

    public function rules()
    {
        return [
            [['name'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}