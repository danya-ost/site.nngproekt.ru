<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DepartmentContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%department_content}}';
    }

    public function rules()
    {
        return [
            [['data_key'], 'trim'],
            [['department_id'], 'trim'],
            [['middle_id'], 'trim'],
            [['bottom_id'], 'trim'],
            [['title'], 'trim'],
            [['telephone'], 'trim'],
        ];
    }
}