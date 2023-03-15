<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Survey extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%survey}}';
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