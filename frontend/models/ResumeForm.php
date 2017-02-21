<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * PositionCate is the model behind the contact form.
 */
class Resume extends ActiveRecord
{
    public static function tableName()
    {
        return "lg_resume";
    }
}