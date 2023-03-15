<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class UserTelephone extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_telephone}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['telephone'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}