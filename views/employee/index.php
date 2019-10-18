<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmployeeSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use app\components\grid\GridView;
use app\models\Arrival;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$pjaxId = 'employee-pjax-id';
$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
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
            'attribute' => 'employee.first_name',
            'label' => Yii::t('app', 'First Name'),
        ],
        [
            'attribute' => 'employee.last_name',
            'label' => Yii::t('app', 'Last Name'),
        ],
        [
            'attribute' => 'is_late',
            'label' => Yii::t('app', 'Late Arrivals')
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '<div class="pull-right">{update}{delete}</div>',
            'buttons' =>
                [
                    'update' => function ($url, Arrival $model) {
                        $url = Url::to(['employee/update', 'id' => $model->employee_id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => 'Update',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-modal-control',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top'
                        ]);
                    },
                    'delete' => function ($url, Arrival $model) use ($pjaxId) {
                        $url = Url::to(['employee/delete', 'id' => $model->employee_id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'data-pjax' => '0',
                            'data-pjax-id' => $pjaxId,
                            'data-json-response' => '1',
                            'class' => 'btn btn-sm delete-button btn-control-confirm btn-confirm',
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

