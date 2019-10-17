<?php

namespace app\components\controllers;

use app\components\actions\SearchAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\components\actions\CreateAction;
use app\components\actions\ViewAction;
use app\components\actions\UpdateAction;
use app\components\actions\DeleteAction;

/**
 * Class CrudController
 *
 */
class CrudController extends BaseController
{

    public function actions()
    {
        /* @var $modelClass \app\components\orm\ActiveRecord */
        $modelClass = $this->modelClass;

        return ArrayHelper::merge([
            'index' => [
                'class' => SearchAction::class,
                'searchModel' => $this->searchModelClass,
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $modelClass,
                'scenario' => $modelClass::SCENARIO_CREATE
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $modelClass,
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $modelClass,
                'scenario' => $modelClass::SCENARIO_UPDATE,
                'findModel' => function ($id) {
                    return $this->findModel($id);
                }
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $modelClass,
            ],
        ], $this->extendedActions());
    }

    public function extendedActions()
    {
        return [];
    }


}
