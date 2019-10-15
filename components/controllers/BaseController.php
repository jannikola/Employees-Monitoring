<?php

namespace app\components\controllers;

use app\components\orm\ActiveRecord;
use app\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class BaseController extends \yii\web\Controller
{
    /** @var string */
    public $modelClass;
    public $searchModelClass;

    public function behaviors()
    {
        $behaviors = [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ],
            ],
        ];

        return ArrayHelper::merge(
            $behaviors,
            $this->extendedBehaviors()
        );
    }

    public function extendedBehaviors()
    {
        return [];
    }

    public function init()
    {
        parent::init();

        static::setLanguage();
    }

    public static function setLanguage($lang = null)
    {
        $session = Yii::$app->session;

        if ($lang) {
            $session->set('language', $lang);
        } else {
            $lang = $session->get('language', 'en');
        }

        if (!empty($lang)) {
            Yii::$app->language = $lang;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@app/views/site/error'
            ],
        ];
    }

    /**
     * Render view depending weather it is ajax request or not
     *
     * @param $view
     * @param array $params
     * @return string
     */
    public function renderAjaxConditional($view, array $params = [])
    {
        return Yii::$app->request->getIsAjax() ? $this->renderAjax($view, $params) : $this->render($view, $params);
    }


    /**
     * Finds the CommissionRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;

        /** @var $model ActiveRecord */
        if (($model = $modelClass::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}