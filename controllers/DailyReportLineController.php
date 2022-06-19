<?php

namespace app\controllers;

use Yii;
use app\models\apps\TDailyReportLine;
use app\models\apps\TProject;
use app\models\search\TDailyReportLineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DailyReportLineController implements the CRUD actions for TDailyReportLine model.
 */
class DailyReportLineController extends Controller
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
     * Lists all TDailyReportLine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TDailyReportLineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TDailyReportLine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $project = TProject::findOne($this->findModel($id)->t_project_id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'project' => $project
        ]);
    }

    /**
     * Creates a new TDailyReportLine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($report_id, $project_id)
    {
        $model = new TDailyReportLine();
        $model->t_daily_report_id = $report_id;
        $model->t_project_id = $project_id;
        $model->status = 1;

        $project = TProject::findOne($project_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!is_null($project_id)) {
                return $this->redirect(['/daily-report/view?id=' . $model->t_daily_report_id . '&project_id=' . $model->t_project_id]);
            }
            

            Yii::$app->session->setFlash('success', "Data Berhasil disimpan.");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'project' => $project
        ]);
    }

    /**
     * Updates an existing TDailyReportLine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $project_id)
    {
        $model = $this->findModel($id);

        $project = TProject::findOne($project_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // if (!is_null($project_id)) return $this->redirect(['/project/view', 'id' => $project_id]);

            if (!is_null($project_id)) {
                // return $this->redirect(['/project/view', 'id' => $project_id]);
                return $this->redirect(['/daily-report/view?id=' . $model->t_daily_report_id . '&project_id=' . $project_id]);
            }
            
            Yii::$app->session->setFlash('success', "Data Berhasil diubah.");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'project' => $project
        ]);
    }

    /**
     * Deletes an existing TDailyReportLine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/daily-report/view?id=' . $model->t_daily_report_id . '&project_id=' . $model->t_project_id]);
    }

    /**
     * Finds the TDailyReportLine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TDailyReportLine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TDailyReportLine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
