<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Logs extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%logs}}';
    }

    public function rules()
    {
        return [
            [['data_core'], 'trim'],
            [['data_key'], 'trim'],
            [['data_log'], 'trim'],
            [['user_id'], 'required'],
            [['success'], 'trim'],
            [['error'], 'trim'],
        ];
    }
}