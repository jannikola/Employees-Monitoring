<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\models;


use app\components\orm\ActiveRecord;

/**
 * Arrival model
 *
 * @property integer $id
 * @property integer $date
 * @property integer $time
 * @property integer $is_late
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $is_deleted
 *
 * @property Employee $employee
 */
class Arrival extends ActiveRecord
{
    const DEADLINE = '08:45';

    public static function tableName()
    {
        return 'arrival';
    }

    public function rules()
    {
        return [
            [['employee_id', 'time'], 'required'],
            [['date', 'is_late'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted'], 'integer'],
        ];
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->date = date("Y-m-d");
        }
        $onTime = $this->date . ' ' . self::DEADLINE;
        $arrivedAt = date('Y-m-d') . ' ' . $this->time;
        $onTime < $arrivedAt ? $this->is_late = 1 : $this->is_late = 0;

        return true;
    }


}