<?php


use yii\bootstrap\ActiveForm; ?>

<div>
    <?php $form = ActiveForm::begin([
        'id' => $model->getFormId(),
        'action' => $model->isNewRecord ? ['employee/create'] : ['employee/update', 'id' => $model->id],
        'options' => ['enctype' => 'multipart/form-data', 'data-grid-id' => 'employee-pjax-id'],
    ]); ?>

    <?= $form->field($model, 'first_name', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'First name')],
    ])->textInput() ?>

    <?= $form->field($model, 'last_name', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Last name')],
    ])->textInput() ?>


    <?php ActiveForm::end(); ?>
</div>