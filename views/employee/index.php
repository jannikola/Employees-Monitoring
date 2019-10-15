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

?>

<?= Html::a('New',
    ['create'],
    ['class' => 'btn pull-right btn-modal-control']);
?>

<?= GridView::widget([
//    'pjaxId' => $pjaxId,
//    'onAfterPjaxReload' => new yii\web\JsExpression("function() {
//                        $.pjax.reload({
//                            container:'#yearPjaxCleaning',
//                            push: false,
//                            replace: false,
//                            timeout: 10000
//                        });
//
//                        $('#" . $pjaxId . "').off('pjax:complete');
//                    }"),
//    'showFooter' => true,
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
    ],
]); ?>
