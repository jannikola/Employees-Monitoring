<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\helpers;


use app\models\Employee;

class EmployeeHelper
{
    public static function getEmployees()
    {
        $employees = Employee::find()->select(['id', 'first_name'])->asArray()->all();

        return ArrayHelper::map($employees, 'id', 'first_name');
    }
}