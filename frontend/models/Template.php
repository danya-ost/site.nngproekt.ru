<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Template extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%template}}';
    }

    public function rules()
    {
        return [
            [['data_key'], 'trim'],
            [['data_key_content'], 'trim'],
            [['content'], 'trim'],
            [['user_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}