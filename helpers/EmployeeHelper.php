<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\helpers;


use app\models\Employee;
use yii\db\Expression;

class EmployeeHelper
{
    public static function getEmployees()
    {
        $employees = Employee::find()->select(['id', 'full_name' => new Expression("CONCAT(first_name, ' ', last_name)")])->asArray()->all();

        return ArrayHelper::map($employees, 'id', 'full_name');
    }
}