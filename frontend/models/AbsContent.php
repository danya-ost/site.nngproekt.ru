<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AbsContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%abs_content}}';
    }

    public function rules()
    {
        return [
            [['abs_id'], 'required'],
            [['title'], 'trim'],
            [['content'], 'trim'],
        ];
    }
}