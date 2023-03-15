<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AppealsContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%appeals_content}}';
    }

    public function rules()
    {
        return [
            [['appeals_id'], 'required'],
            [['title'], 'trim'],
            [['message_text'], 'trim'],
        ];
    }
}