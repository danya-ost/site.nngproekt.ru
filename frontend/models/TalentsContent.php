<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_content}}';
    }

    public function rules()
    {
        return [
            [['talents_id'], 'required'],
            [['title'], 'trim'],
            [['annotation'], 'trim'],
            [['content'], 'trim'],
        ];
    }
}