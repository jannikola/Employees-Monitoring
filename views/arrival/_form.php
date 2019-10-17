<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

use app\helpers\EmployeeHelper;
use dosamigos\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;

?>

    <div>
        <?php $form = ActiveForm::begin([
            'id' => $model->getFormId(),
            'action' => $model->isNewRecord ? ['arrival/create'] : ['arrival/update', 'id' => $model->id],
            'options' => ['enctype' => 'multipart/form-data', 'data-grid-id' => 'arrival-pjax-id'],
        ]); ?>

        <?= $form->field($model, 'employee_id', [
            'template' => '<div class="row"><div class="col-md-12" >{input}{error}</div></div>'
        ])->widget(
            Select2::class, [
                'items' => EmployeeHelper::getEmployees(),
                'clientOptions' => [
                    'placeholder' => 'Choose Employee'
                ]
            ]
        )->label(false); ?>

        <?= $form->field($model, 'date', [
            'inputOptions' => ['placeholder' => Yii::t('app', 'Date')],
        ])->textInput() ?>


        <?=$form->field($model, 'time')->widget(TimePicker::class, [
            'pluginOptions' => [
                'showMeridian' => false,
            ]
        ]); ?>

        <?= $form->field($model, 'is_late', [
            'inputOptions' => ['placeholder' => Yii::t('app', 'Is late?')],
        ])->textInput() ?>


        <?php ActiveForm::end(); ?>
    </div>