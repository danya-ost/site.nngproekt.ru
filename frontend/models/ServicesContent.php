<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class ServicesContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%services_content}}';
    }

    public function rules()
    {
        return [
            [['services_id'], 'required'],
            [['title'], 'trim'],
            [['href'], 'trim'],
        ];
    }
}