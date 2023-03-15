<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AppealsFile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%appeals_file}}';
    }

    public function rules()
    {
        return [
            [['appeals_id'], 'required'],
            [['src'], 'trim'],
            [['type'], 'trim'],
        ];
    }
}