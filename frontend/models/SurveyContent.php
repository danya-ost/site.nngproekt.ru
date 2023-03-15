<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class SurveyContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%survey_content}}';
    }

    public function rules()
    {
        return [
            [['survey_id'], 'required'],
            [['title'], 'trim'],
            [['cover_src'], 'trim'],
            [['href'], 'trim'],
            [['response'], 'trim'],
            [['response_href'], 'trim'],
        ];
    }
}