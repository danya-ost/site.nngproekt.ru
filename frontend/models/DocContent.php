<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class DocContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%doc_content}}';
    }

    public function rules()
    {
        return [
            [['doc_id'], 'required'],
            [['title'], 'trim'],
            [['src'], 'trim'],
        ];
    }
}