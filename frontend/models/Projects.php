<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Projects extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%projects}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}