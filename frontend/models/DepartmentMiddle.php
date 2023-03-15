<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DepartmentMiddle extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department_middle}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['parent_id'], 'trim'],
            [['date_update'], 'trim'],
            [['date_remove'], 'trim'],
            [['status'], 'trim'],
            [['status_delete'], 'trim'],
        ];
    }
}