<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class InformationContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%information_content}}';
    }

    public function rules()
    {
        return [
            [['information_id'], 'trim'],
            [['title'], 'trim'],
            [['src'], 'trim'],
        ];
    }
}