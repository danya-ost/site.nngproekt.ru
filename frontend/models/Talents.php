<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Talents extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['department_id'], 'required'],
            [['category_id'], 'required'],
            [['views'], 'trim'],
            [['likes'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}