<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::className(), [
        'inline' => false, 
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'd-M-yyyy'
        ]]);
    ?>
    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       <button type="button" class="btn btn-default CancelButton"> Cancel</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
    if (Yii::$app->session->getFlash('success') != '') {
            $this->registerJs('
                    setTimeout(function(){
                        parent.window.$("#Employeedetails").modal("hide");
                    }, 1500);
                   parent.Reloadviewpage();
        ',$this::POS_READY,'');
    }
$this->registerJs('  
                     
    $( ".CancelButton" ).click(function() {
      parent.window.$("#Employeedetails").modal("hide");
    });                 
',$this::POS_READY,'');    
