# Note module

* Add module namespace in composer
            
      "autoload" : {
           "psr-4": {
                 "modal\\": "common/widgets/modal"
           }
      },
      
* Echo widget into main layout
        
      <?= Modal::widget(); ?>
      
* Use "btn-modal-control" class to open link in modal
                
      <?= Html::a('Open modal', ['site/index'], ['class' => 'btn btn-primary btn-modal-conrol']) ?>
 
* Action should return respond to an AJAX request
        
      function actionIndex()
      {
            return $this->renderAjax('index', [
                'content' => 'Modal content'
            ])
      }
      
* View content should be wrapped into ModalContent Widget

      <?php ModalContent::begin([
         'title' => $this->title,
         'footer' => Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) .
             Html::submitButton('Save', ['class' => 'btn btn-success btn-modal-control-submit', 'data-form-id' => $model->getFormId()]),
      ]) ?>
     
         <?= $this->render('_form', [
             'model' => $model,
         ]) ?>
     
      <?php ModalContent::end(); ?>
      
* Submit button in modal form must have "btn-modal-control-submit" class and submit will trigger 'modal-submitted' event

        (function() {
            $(document).on('modal-submitted', function (e, data, btn, form) {
                if (data.success) {
                    $.pjax.reload({container: '#{$pjaxId}', timeout: 10000});
                }
            });
        })();