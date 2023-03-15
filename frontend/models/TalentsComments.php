<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class TalentsComments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%talents_comments}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['talents_id'], 'required'],
            [['comment'], 'trim'],
            [['parent_comment_id'], 'trim'],
            [['status'], 'trim'],
        ];
    }
}