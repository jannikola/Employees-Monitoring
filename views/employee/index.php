<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmployeeSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use app\components\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$pjaxId = 'employee-pjax-id';

?>

<?= Html::a('New',
    ['create'],
    ['class' => 'btn pull-right btn-modal-control']);
?>
<?php Pjax::begin(['id' => $pjaxId]); ?>
<?= GridView::widget([
    'pjaxId' => $pjaxId,
    'onAfterPjaxReload' => new yii\web\JsExpression("function() {
                        $.pjax.reload({
                            container:'#yearPjaxCleaning',
                            push: false,
                            replace: false,
                            timeout: 10000
                        });

                        $('#" . $pjaxId . "').off('pjax:complete');
                    }"),
    'showFooter' => true,
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'first_name',
            'label' => Yii::t('app', 'Name'),
        ],
        [
            'attribute' => 'last_name',
            'label' => Yii::t('app', 'Last Name'),
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '<div class="pull-right">{update}{delete}</div>',
            'buttons' =>
                [
                    'update' => function ($url, $model) {
                        $url = Url::to(['employee/update', 'id' => $model->id]);
                        return Html::a('<i class="fal fa-wrench"></i>', $url, ['title' => \Yii::t('app', 'Update'), 'class' => 'btn btn-sm btn-icon-only rounded-circle btn-modal-control', 'data-toggle' => 'tooltip', 'data-placement' => 'top']);
                    },
                    'delete' => function ($url, $model) use ($pjaxId) {
                        $url = Url::to(['employee/delete', 'id' => $model->id]);
                        return Html::a('<i class="fal fa-trash"></i>', $url, ['title' => \Yii::t('app', 'Delete'),
                            'data-pjax' => '0',
                            'data-pjax-id' => $pjaxId,
                            'data-json-response' => '1',
                            'data-msg' => Yii::t('app', 'Do you want to delete {:name}?', [':name' => $model->first_name]),
                            'class' => 'btn btn-sm btn-icon-only rounded-circle delete-button btn-control-confirm',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top']);
                    },
                ],
        ],
    ],
]);

?>
<?php Pjax::end(); ?>
