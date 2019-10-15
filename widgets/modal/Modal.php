<?php
namespace modal;



class Modal extends \yii\bootstrap\Modal
{
    public $size = parent::SIZE_LARGE;
    public $options = ['tabindex'=>false];

    public function init()
    {
        parent::init();

        $view = $this->getView();
        ModalAssets::register($view);
        $view->registerJs("modal.init({modalId:'{$this->id}'})");
    }
}