<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Department extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['bottoms'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}