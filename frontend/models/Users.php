<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * PositionCate is the model behind the contact form.
 */
class Users extends ActiveRecord
{
    public static function tableName()
    {
        return "lg_users";
    }
}


