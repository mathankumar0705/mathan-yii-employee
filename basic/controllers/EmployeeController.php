<?php

namespace app\controllers;

use Yii;
use app\models\Employee;
use app\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNew()
    {
        if (Yii::$app->request->get('popup')) {
            $this->layout = '/popup';
        }
        $model = new Employee();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at=date('Y-m-d');
            $model->created_by=0;
            $model->dob = date('Y-m-d',strtotime($_POST['Employee']['dob']));
            if($model->save()){
                Yii::$app->session->setFlash('success','New Employee Saved Successfully');
            }
           
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->get('popup')) {
            $this->layout = '/popup';
        }
        $model = $this->findModel($id);
        $model->dob = date('d-M-Y',strtotime($model->dob));
        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at=date('Y-m-d');
            $model->updated_by=0;
            $model->dob = date('Y-m-d',strtotime($_POST['Employee']['dob']));
            if($model->save()){
               Yii::$app->session->setFlash('success','Employee Updated Successfully');
            }
        }
            //return $this->redirect(['view', 'id' => $model->id]);
      
        return $this->render('update', [
            'model' => $model,
        ]);
    
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
