<?php

namespace app\controllers;

use Yii;
use app\models\apps\TDailyReport;
use app\models\apps\TProject;
use app\models\search\TDailyReportLineSearch;
use app\models\search\TDailyReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DailyReportController implements the CRUD actions for TDailyReport model.
 */
class DailyReportController extends Controller
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
     * Lists all TDailyReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TDailyReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TDailyReport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModelLine = new TDailyReportLineSearch();
        $dataProviderLine = $searchModelLine->search(Yii::$app->request->queryParams);
        $dataProviderLine->query->andWhere(['t_daily_report_id' => $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelLine' => $searchModelLine,
            'dataProviderLine' => $dataProviderLine,
            'project' => TProject::findOne($this->findModel($id)->t_project_id),
        ]);
    }

    /**
     * Creates a new TDailyReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id = null)
    {
        $model = new TDailyReport();
        $model->t_project_id = $project_id;
        $project = TProject::findOne($project_id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->uploadFile('file_path', 'file1') && $model->save()) {
                Yii::$app->session->setFlash('success', "Data Berhasil disimpan.");
                
                if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Updates an existing TDailyReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $project_id = null)
    {
        $model = $this->findModel($id);
        $model->date = date('Y-m-d', strtotime($model->date));
        $project = TProject::findOne($project_id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->uploadFile('file_path', 'file1') && $model->save()) {
                Yii::$app->session->setFlash('success', "Data Berhasil diubah.");

                if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);
                
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Deletes an existing TDailyReport model.
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
     * Finds the TDailyReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TDailyReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TDailyReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
