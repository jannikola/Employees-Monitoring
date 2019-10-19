<?php
/**
 * Created by Nikola Jankovic.
 * email: jannikola@gmail.com
 */

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ArrivalSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use app\components\grid\GridView;
use app\helpers\TimeHelper;
use app\models\Arrival;
use janisto\timepicker\TimePicker;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$pjaxId = 'arrival-pjax-id';
$this->title = 'Arrivals';
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
            'attribute' => 'employee_id',
            'value' => 'employee.fullName',
            'label' => Yii::t('app', 'Employee')
        ],
        [
            'attribute' => 'date',
            'label' => Yii::t('app', 'Date'),
            'value' => function (Arrival $model) {
                return \app\helpers\TimeHelper::formatSqlDateToLocalDate($model->date);
            }
        ],
        [
            'attribute' => 'time',
            'label' => Yii::t('app', 'Time'),
            'value' => function(Arrival $model) {
                return TimeHelper::formatTimeToShortTime($model->time);
            },
        ],
        [
            'attribute' => 'is_late',
            'label' => Yii::t('app', 'Is late'),
            'value' => function(Arrival $model) {
                return $model->is_late ? 'Yes' : 'No';
            },
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '<div class="pull-right">{update}{delete}</div>',
            'buttons' =>
                [
                    'update' => function ($url, $model) {
                        $url = Url::to(['arrival/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => 'Update',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-modal-control',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top'
                        ]);
                    },
                    'delete' => function ($url, Arrival $model) use ($pjaxId) {
                        $url = Url::to(['arrival/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'data-pjax' => '0',
                            'data-pjax-id' => $pjaxId,
                            'data-json-response' => '1',
                            'class' => 'btn btn-sm delete-button btn-control-confirm',
                            'data-msg' => Yii::t('app', 'Do you want to delete arrival for {:name}?', [':name' => $model->employee ? $model->employee->getFullName() : 'employee']),
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
