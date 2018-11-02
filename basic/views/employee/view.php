<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->emp_name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h4><?= Html::encode($this->title) ?></h4>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'emp_name',
            'emp_id',
            'email:email',
            'phone_no',
            [                     
            'label' => 'Dob',
            'value' => date('d-M-Y',strtotime($model->dob)),
        ],
        ],
    ]) ?>

</div>
