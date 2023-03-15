<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class UserAvatar extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_avatar}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['src'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}