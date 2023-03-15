<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Appeals extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%appeals}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['status_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}