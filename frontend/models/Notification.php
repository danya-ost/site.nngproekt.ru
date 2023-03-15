<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Notification extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%notification}}';
    }

    public function rules()
    {
        return [
            [['data_key'], 'trim'],
            [['user_id'], 'required'],
            [['message'], 'trim'],
            [['is_href'], 'trim'],
            [['href'], 'trim'],
            [['ready'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}