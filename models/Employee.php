<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\models;


use app\components\orm\ActiveRecord;

/**
 * Employee model
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $is_deleted
 */

class Employee extends ActiveRecord
{

    public static function tableName()
    {
        return 'employee';
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted'], 'integer'],
        ];
    }

}