<?php

use app\widgets\modal\ModalContent;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\Employee */

$this->title = 'Update employee';

?>

<div>

    <?php ModalContent::begin([
        'title' => $this->title,
        'footer' =>
            Html::button('Cancel', ['class' => 'btn btn-link  ml-auto', 'data-dismiss' => 'modal']) .
            Html::submitButton('Save', ['class' => 'btn btn-primary btn-modal-control-submit', 'data-form-id' => $model->getFormId()])
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php ModalContent::end(); ?>

</div>