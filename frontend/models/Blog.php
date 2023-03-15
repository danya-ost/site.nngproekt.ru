<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Blog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%blog}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['views'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}