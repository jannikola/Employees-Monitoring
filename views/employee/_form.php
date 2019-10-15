<?php


use yii\bootstrap\ActiveForm; ?>

<div>
    <?php $form = ActiveForm::begin([
        'id' => $model->getFormId(),
        'action' => $model->isNewRecord ? ['employee/create'] : ['employee/update', 'id' => $model->id],
        'options' => ['enctype' => 'multipart/form-data', 'data-grid-id' => 'cleaning-pjax-id'],
    ]); ?>

    <?= $form->field($model, 'first_name', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add name')],
    ])->textInput() ?>

    <?= $form->field($model, 'last_name', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add last name')],
    ])->textInput() ?>


    <?php ActiveForm::end(); ?>
</div>