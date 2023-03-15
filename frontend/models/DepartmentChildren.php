<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DepartmentChildren extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department_children}}';
    }

    public function rules()
    {
        return [
            [['parent_key'], 'trim'],
            [['parent_id'], 'trim'],
            [['child_key'], 'trim'],
            [['child_id'], 'trim'],
        ];
    }
}