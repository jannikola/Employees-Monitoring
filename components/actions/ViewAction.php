<?php

namespace app\components\actions;
use Yii;

/**
 * Class ViewAction
 *
 */
class ViewAction extends ItemAction
{
    /**
     * @var string the name of the view action.
     */
    public $view = 'view';

    /**
     * @var string the name of the view action.
     */
    public $modalView = 'view_modal';

    /**
     * @param string $id
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess($model);

        $params = $this->resolveParams(['model' => $model]);

        return $this->render($params);
    }

    private function render(array $params = [])
    {
        $view = Yii::$app->request->getIsAjax() ? $this->modalView : $this->view;

        return $this->controller->renderAjaxConditional($view, $params);
    }
}
