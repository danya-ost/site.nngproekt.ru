<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class NavbarContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%navbar_content}}';
    }

    public function rules()
    {
        return [
            [['navbar_id'], 'required'],
            [['data_key'], 'trim'],
            [['title'], 'trim'],
            [['href'], 'trim'],
            [['svg'], 'trim'],
        ];
    }
}