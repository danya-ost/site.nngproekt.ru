<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class FileContent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%files_content}}';
    }

    public function rules()
    {
        return [
            [['file_id'], 'required'],
            [['name'], 'trim'],
            [['alias'], 'trim'],
            [['src'], 'trim'],
        ];
    }
}