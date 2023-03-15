<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class ProjectsContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%projects_content}}';
    }

    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['customer_id'], 'required'],
            [['number_customer'], 'trim'],
            [['number_in'], 'trim'],
            [['date'], 'trim'],
            [['title'], 'trim'],
            [['text'], 'trim'],
        ];
    }
}