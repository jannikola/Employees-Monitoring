<?php

namespace app\widgets\modal;


use yii\base\InvalidCallException;
use yii\base\Widget;
use yii\helpers\Html;

class ModalContent extends Widget
{
    /**
     * @var array HTML attributes for the header div tag. Default is `['class' => 'modal-header']`.
     */
    public $headerOptions = ['class' => "modal-header"];
    /**
     * @var string Title of modal window. If not set title tag is not rendered.
     */
    public $title;
    /**
     * @var array HTML attributes for the title h4 tag. Default is `['class' => 'modal-title']`.
     */
    public $titleOptions = ['class' => 'modal-title'];
    /**
     * @var string HTML of modal footer. If not set footer is not rendered.
     */
    public $footer;
    /**
     * @var array HTML attributes for the content div tag. Default is `['class' => 'modal-body']`.
     */
    public $contentOptions = ['class' => 'modal-body'];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        ob_start();
        ob_implicit_flush(false);
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $content = ob_get_clean();

        echo Html::beginTag('div', $this->headerOptions);

        echo $this->getTitle();

        echo $this->getHeaderButtons();


        echo Html::endTag('div');

        echo Html::tag('div', $content, $this->contentOptions);

        echo $this->getFooter();
    }

    private function getHeaderButtons()
    {
        $buttons = Html::button('<span aria-hidden="true">&times;</span>', [
                'class' => 'close',
                'data-dismiss' => 'modal',
                'aria-label' => 'Close'
            ]) . "\n";

        return $buttons;
    }

    private function getTitle()
    {
        if (empty($this->title)) {
            return '';
        }

        return Html::tag('h4', Html::tag('strong', $this->title), $this->titleOptions);
    }

    private function getFooter()
    {
        if (empty($this->footer)) {
            return '';
        }

        return Html::tag('div', $this->footer, ['class' => 'modal-footer']);
    }
}