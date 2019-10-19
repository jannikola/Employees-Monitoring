<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

use app\widgets\modal\ModalContent;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Adding new arrival');
$model->time = \app\helpers\TimeHelper::createDateObjectFromString()->format('H:i');
?>

<div>

    <?php ModalContent::begin([
        'title' => $this->title,
        'footer' =>
            Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-link  ml-auto', 'data-dismiss' => 'modal']) .
            Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-modal-control-submit', 'data-form-id' => $model->getFormId()])
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php ModalContent::end(); ?>

</div>