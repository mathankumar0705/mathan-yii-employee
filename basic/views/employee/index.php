<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseurl = Yii::$app->request->baseUrl;
$this->title = 'Employee List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
    
   
    @-moz-document url-prefix() { 
        #addemployeeIframe{
            min-height:450px !important;
            width: 100% !important;
            border: 0px;
        }
    }  
    #addemployeeIframe{
        min-height:700px !important;
        width: 100% !important;
        border: 0px;
    }

    .modal-backdrop {
        z-index: 0 !important;
    }
    .input-group{
         z-index: 0 !important;
    }
       
");
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <button class = "btn btn-success Registers">New Employee</button>
    </p>
    <?php Pjax::begin(['id' => 'pjax-employeegridview', 'timeout' => 1000]); ?>
       

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'emp_id',
                'emp_name',
                'email:email',
                'phone_no',
                [
                    'attribute'=>'dob',
                    'value' =>'dob',
                    'filter'=>DatePicker::widget([
                        'model' => $searchModel,
                        'attribute'=>'dob',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-M-yyyy'
                        ]
                    ]),
                    'content' => function ($dataProvider) {
                        $dob_date = $dataProvider->dob;
                        $date = '';       
                        if (!empty($dob_date)){
                            $date .=  date('d-m-Y', strtotime($dob_date)) ;
                        }
                        return $date;
                    }  
                ],
          

                ['header'=>'Action',
                    'headerOptions' => ['style'=>'width:7%;'],
                    'content'=>function($data){
                        return '<a href="'.Yii::$app->urlManager->createUrl('employee/view?id=').$data->id.'" style="text-decoration:none">
                           <i class="glyphicon glyphicon-eye-open"></i>
                        </a> 
                        <a href="javascript:void(0)" id="update_employee" style="text-decoration:none" data-id = "'.$data->id.'">
                          <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="'.Yii::$app->urlManager->createUrl('employee/delete?id=').$data->id.'" data-method="post" data-confirm="Are you sure you want to delete?">
                          <i class="glyphicon glyphicon-trash"></i>
                        </a>';
                }], 
            ],
        ]); ?>
     <?php Pjax::end(); ?>
</div>


<div class="col-md-12">
    <section class="panel">
         <div class="modal fade" id="Employeedetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
               aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-style">
                    <div class="modal-header">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"
                              aria-hidden="true" style="float:right">&times;</button>
                        <h4 class="modal-title">New Employee</h4>
                    </div>
                    <div class="modal-body" id="Employeemodel">
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>



<?php
$this->registerJs("
    $(document).on('click', '.Registers', function() {
        var baseurl  = '".$baseurl."';
        var eventiframe = '<iframe id=addemployeeIframe src='+baseurl+'/employee/new?popup=popup> </iframe>';
        $('#Employeemodel').html(eventiframe).css({zoom:'0.60', width:'99.6%',});
        $('.modal-title').html('New Employee');
        $('#Employeedetails').modal('show');
    });
    $(document).on('click', '#update_employee', function() {
        var id =  $(this).data('id');
        var baseurl  = '".$baseurl."';
        var eventiframe = '<iframe id=addemployeeIframe src='+baseurl+'/employee/update?popup=popup&id='+id+'> </iframe>';
        $('#Employeemodel').html(eventiframe).css({zoom:'0.60', width:'99.6%',});
        $('.modal-title').html('Update Employee');
        $('#Employeedetails').modal('show');
    });
    
",$this::POS_READY);

$this->registerJs('
    Reloadviewpage = function Reloadviewpage(){
        $.pjax.reload({container:"#pjax-employeegridview",timeout:"1000"}); 
    }
', $this::POS_READY);


