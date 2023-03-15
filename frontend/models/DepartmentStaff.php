<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DepartmentStaff extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department_staff}}';
    }

    public function rules()
    {
        return [
            [['data_key'], 'trim'],
            [['user_id'], 'required'],
            [['department_key'], 'trim'],
            [['department_id'], 'trim'],
        ];
    }
}