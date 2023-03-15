<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class AppealsStatus extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%appeals_status}}';
    }
}