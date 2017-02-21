<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * PositionCate is the model behind the contact form.
 */
class Position extends ActiveRecord
{
    public static function tableName()
    {
        return "lg_position";

    }
}
