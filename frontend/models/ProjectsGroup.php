<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class ProjectsGroup extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%projects_group}}';
    }

    public function rules()
    {
        return [
            [['name'], 'trim'],
        ];
    }
}