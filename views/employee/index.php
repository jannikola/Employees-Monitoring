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
use app\models\Employee;

$pjaxId = 'employee-pjax-id';

?>

<?= Html::a('New',
    ['create'],
    ['class' => 'btn btn-primary pull-right btn-modal-control']);
?>
<?php Pjax::begin(['id' => $pjaxId]); ?>
<?= GridView::widget([
    'pjaxId' => $pjaxId,
    'showFooter' => true,
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'first_name',
            'label' => Yii::t('app', 'First Name'),
        ],
        [
            'attribute' => 'last_name',
            'label' => Yii::t('app', 'Last Name'),
        ],
        [
            'attribute' => 'late_arrival_count',
            'label' => Yii::t('app', 'Late Arrivals')
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '<div class="pull-right">{update}{delete}</div>',
            'buttons' =>
                [
                    'update' => function ($url, \app\models\Employee $model) {
                        $url = Url::to(['employee/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => 'Update',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-modal-control',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top'
                        ]);
                    },
                    'delete' => function ($url, Employee $model) use ($pjaxId) {
                        $url = Url::to(['employee/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'data-pjax' => '0',
                            'data-pjax-id' => $pjaxId,
                            'data-json-response' => '1',
                            'data-msg' => Yii::t('app', 'Do you want to delete {:name}?', [':name' => $model->getFullName()]),
                            'class' => 'btn btn-sm btn-icon-only rounded-circle btn-control-confirm',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top'
                        ]);
                    },
                ],
        ],
    ],
]);

?>
<?php Pjax::end(); ?>


