<?php

namespace app\components\grid;

use \yii\grid\ActionColumn;

/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 24.6.2018.
 * Time: 00:37
 */

class GridView extends \yii\grid\GridView
{
    public $pjaxId;
    public $tableOptions = ['class' => 'table align-items-center table-flush table-responsive'];
    public $headerRowOptions = ['class' => 'thead-light'];
    public $layout = "{items}\n{pager}";

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->tableOptions = ['class' => 'table align-items-center table-flush table-responsive table-hover'];
        if ($this->pjaxId) {
            $view = $this->getView();

            $view->registerJs("$(document).on('modal-submitted', function(event, data, status, xhr, options) {
                if (data.success) { 
                        $.pjax.reload({
                            container:'#{$this->pjaxId}',
                            push: false, 
                            replace: false, 
                            timeout: 10000
                        });
                }
            });");
        }

        parent::run();
    }

    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns()
    {
        parent::initColumns();

        foreach ($this->columns as &$column) {
            if ($column instanceof ActionColumn) {
                $btnCount = count($column->buttons);

                $column->headerOptions = ['class' => "action-col col-btns-{$btnCount}"];
                $column->filterOptions = ['class' => "action-col col-btns-{$btnCount}"];
                $column->contentOptions = ['class' => "action-col col-btns-{$btnCount}"];
            }

            if ($column->hasProperty('attribute') && $column->attribute == 'id') {
                $column->headerOptions = ['class' => "id-col w-80"];
                $column->filterOptions = ['class' => "id-col w-80"];
                $column->contentOptions = ['class' => "id-col w-80"];
            }

            if ($column->hasProperty('format') && $column->format == 'boolean') {
                $column->headerOptions = ['class' => "bool-col w-100"];
                $column->filterOptions = ['class' => "bool-col w-100"];
                $column->contentOptions = ['class' => "bool-col w-100"];
            }
        }
    }
}