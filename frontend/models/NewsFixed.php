<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NewsFixed extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news_fixed}}';
    }

    public function rules()
    {
        return [
            [['news_id'], 'required'],
            [['status'], 'trim'],
        ];
    }
}