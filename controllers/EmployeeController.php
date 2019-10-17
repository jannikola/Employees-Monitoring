<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\controllers;

use app\components\controllers\CrudController;
use app\models\Employee;
use app\models\search\EmployeeSearch;
use yii\filters\AccessControl;

class EmployeeController extends CrudController
{
    public $modelClass = Employee::class;
    public $searchModelClass = EmployeeSearch::class;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ]
        ];
    }
}