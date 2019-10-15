<?php

namespace app\components\actions;

use Yii;
use yii\web\Response;
use yii\db\BaseActiveRecord;
use yii\bootstrap\ActiveForm;
use app\helpers\FlashHelper;
use app\components\orm\ActiveRecord;

/**
 * Class UpdateAction
 *
 */
class UpdateAction extends ItemAction
{
    /**
     * @var string the name of the view action.
     */
    public $view = 'update';

    public $modalView = 'update_modal';

    /**
     * @var callable
     * The signature of the callable should be:
     *
     * ```php
     * function ($model) {
     *     // $model is the requested model instance.
     *     return $this->redirect(['my-action', 'id' => $model->getPrimaryKey()]);
     * }
     * ```
     */
    public $afterUpdate;

    /**
     * @param string $id
     *
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id = null)
    {
        /** @var ActiveRecord $model */
        $model = $this->findModel($id);
        $this->checkAccess($model);
        $model->setScenario($this->scenario);
        $model->setAttributes(\Yii::$app->getRequest()->get());

        $this->controller->getView()->title = "Update {$model->getPublicName()}";

        if ($model->load(\Yii::$app->getRequest()->post())) {
            if ($model->save()) {

                $message = Yii::t('app', '{:model} successfully updated!', [':model' => $model->getPublicName()]);

                if (Yii::$app->request->getIsAjax()) {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    $returnMessage = [
                        'success' => true,
                        'message' => $message
                    ];

                    if (Yii::$app->request->get('returnAttributes', false)) {
                        $attributes = explode(',', Yii::$app->request->get('returnAttributes'));

                        foreach ($attributes as $attribute) {
                            if ($model->hasProperty($attribute)) {
                                $returnMessage['attributes'][$attribute] = $model->{$attribute};
                            } else if ($model->hasAttribute($attribute)) {
                                $returnMessage['attributes'][$attribute] = $model->getAttribute($attribute);
                            } else {
                                $returnMessage['attributes'][$attribute] = null;
                            }
                        }

                    }

                    return $returnMessage;
                }

                FlashHelper::setSuccess($message);

                $afterUpdate = $this->afterUpdate;
                if (empty($afterUpdate)) {
                    $afterUpdate = function (BaseActiveRecord $model) {
                        return $this->controller->redirect(['update', 'id' => $model->getPrimaryKey()]);
                    };
                }

                return call_user_func($afterUpdate, $model);
            } else {
                $errorMessage = $model->getPublicName() . ' cannot be created!<br>' . implode('<br>', $model->getFirstErrors());

                if (Yii::$app->request->getIsAjax()) {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    $returnMessage = [
                        'success' => false,
                        'message' => $errorMessage,
                        'errors' => ActiveForm::validate($model)
                    ];
                    return $returnMessage;
                }

                FlashHelper::setError($errorMessage);
            }
        }

        $params = $this->resolveParams(['model' => $model]);

        return $this->render($params);
    }

    private function render(array $params = [])
    {
        $view = Yii::$app->request->getIsAjax() ? $this->modalView : $this->view;

        return $this->controller->renderAjaxConditional($view, $params);
    }
}
