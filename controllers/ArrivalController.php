<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

namespace app\controllers;


use app\components\controllers\CrudController;
use app\models\Arrival;
use app\models\search\ArrivalSearch;
use yii\filters\AccessControl;

class ArrivalController extends CrudController
{
    public $modelClass = Arrival::class;
    public $searchModelClass = ArrivalSearch::class;

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