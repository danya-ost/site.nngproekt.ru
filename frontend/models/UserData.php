<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class UserData extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_data}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['job'], 'trim'],
            [['surname'], 'trim'],
            [['firstname'], 'trim'],
            [['report'], 'trim'],
            [['fullname'], 'trim'],
            [['birthday_day'], 'trim'],
            [['birthday_month'], 'trim'],
            [['birthday_year'], 'trim'],
            [['birthday_view'], 'trim'],
            [['recruitment'], 'trim'],
            [['address'], 'trim'],
            [['in_work'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}