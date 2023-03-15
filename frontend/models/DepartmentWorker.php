<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DepartmentWorker extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department_worker}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['data_key'], 'trim'],
            [['department_id'], 'trim'],
            [['middle_id'], 'trim'],
            [['bottom_id'], 'trim'],
        ];
    }
}