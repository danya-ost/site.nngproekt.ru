<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class HonorContent extends ActiveRecord
{
    public static function tableName()
    {

        return '{{%honor_content}}';
    }

    public function rules()
    {
        return [
            [['honor_id'], 'required'],
            [['user_id'], 'required'],
            [['text'], 'trim'],
        ];
    }
}