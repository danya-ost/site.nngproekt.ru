<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Services extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%services}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['type_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}