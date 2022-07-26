<?php

namespace app\controllers;

use Yii;
use app\models\apps\TActivity;
use app\models\apps\TProject;
use app\models\search\TActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityController implements the CRUD actions for TActivity model.
 */
class ActivityController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TActivity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'project' => TProject::findOne($this->findModel($id)->t_project_id),
        ]);
    }

    /**
     * Creates a new TActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id = null)
    {
        $model = new TActivity();
        $model->t_project_id = $project_id;
        $project = TProject::findOne($project_id);
        $heaviness = TActivity::find()->where(['t_project_id' => $project_id])->sum('heaviness');

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->post()['TActivity']['status'] != 'finish') $model->finish_date = null;

            if($model->validate() && $model->save()){
                Yii::$app->session->setFlash('success', "Data Berhasil disimpan.");
                
                if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);

                return $this->redirect(['/project/view', 'id' => $project_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'project' => $project,
            'heaviness' => $heaviness
        ]);
    }

    /**
     * Updates an existing TActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $project_id = null)
    {
        $model = $this->findModel($id);
        $project = TProject::findOne($project_id);
        $heaviness = TActivity::find()
            ->where(['t_project_id' => $project_id])
            ->andWhere(['<>', 't_activity_id', $id])
            ->sum('heaviness');

        $model->start_date = date('Y-m-d', strtotime($model->start_date));
        $model->est_finish_date = date('Y-m-d', strtotime($model->est_finish_date));
        if(isset($model->finish_date)) $model->finish_date = date('Y-m-d', strtotime($model->finish_date));

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->post()['TActivity']['status'] != 'finish') $model->finish_date = null;

            if($model->validate() && $model->save()){
                Yii::$app->session->setFlash('success', "Data Berhasil diubah.");
                
                if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'project' => $project,
            'heaviness' => $heaviness
        ]);
    }

    /**
     * Deletes an existing TActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $project_id = null)
    {
        $this->findModel($id)->delete();

        if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the TActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
