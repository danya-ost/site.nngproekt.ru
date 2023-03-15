<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class InitiativeStatus extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%initiative_status}}';
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