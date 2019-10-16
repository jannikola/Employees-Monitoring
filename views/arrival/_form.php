<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

use yii\bootstrap\ActiveForm; ?>

<div>
    <?php $form = ActiveForm::begin([
        'id' => $model->getFormId(),
        'action' => $model->isNewRecord ? ['arrival/create'] : ['arrival/update', 'id' => $model->id],
        'options' => ['enctype' => 'multipart/form-data', 'data-grid-id' => 'arrival-pjax-id'],
    ]); ?>

    <?= $form->field($model, 'employee_id', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add name')],
    ])->textInput() ?>

    <?= $form->field($model, 'date', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add last name')],
    ])->textInput() ?>

    <?= $form->field($model, 'time', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add last name')],
    ])->textInput() ?>

    <?= $form->field($model, 'is_late', [
        'inputOptions' => ['placeholder' => Yii::t('app', 'Add last name')],
    ])->textInput() ?>


    <?php ActiveForm::end(); ?>
</div>
