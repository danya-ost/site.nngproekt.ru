<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsCategory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_category}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['name'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}