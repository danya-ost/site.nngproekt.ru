<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class Initiative extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%initiative}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['department_id'], 'required'],
            [['status_id'], 'required'],
            [['category_id'], 'required'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}