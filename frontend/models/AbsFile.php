<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AbsFile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%abs_file}}';
    }

    public function rules()
    {
        return [
            [['abs_id'], 'required'],
            [['src'], 'trim'],
        ];
    }
}