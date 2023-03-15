<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class InitiativeContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%initiative_content}}';
    }

    public function rules()
    {
        return [
            [['initiative_id'], 'required'],
            [['title'], 'trim'],
            [['problem_text'], 'trim'],
            [['solution_text'], 'trim'],
            [['contacts'], 'trim'],
        ];
    }
}