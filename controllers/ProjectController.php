<?php

namespace app\controllers;

use Yii;
use app\models\apps\TProject;
use app\models\search\TActivityRealisasiSearch;
use app\models\search\TActivitySearch;
use app\models\search\TDailyReportSearch;
use app\models\search\TProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for TProject model.
 */
class ProjectController extends Controller
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
     * Lists all TProject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TProject model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModelPerencanaan = new TActivitySearch();
        $dataProviderPerencanaan = $searchModelPerencanaan->search(Yii::$app->request->queryParams);
        // $dataProviderPerencanaan->query->andWhere(['finish_date' => NULL]);
        $dataProviderPerencanaan->query->andWhere(['t_project_id' => $id]);
        
        $searchModelRealisasi = new TActivityRealisasiSearch();
        $dataProviderRealisasi = $searchModelRealisasi->search(Yii::$app->request->queryParams);
        // $dataProviderRealisasi->query->andWhere(['NOT', ['finish_date' => NULL]]);
        $dataProviderRealisasi->query->andWhere(['t_project_id' => $id]);

        $searchModelLaporan = new TDailyReportSearch();
        $dataProviderLaporan = $searchModelLaporan->search(Yii::$app->request->queryParams);
        $dataProviderLaporan->query->andWhere(['t_project_id' => $id]);

        return $this->render('view', [
            'model' => $model,
            'searchModelPerencanaan' => $searchModelPerencanaan,
            'dataProviderPerencanaan' => $dataProviderPerencanaan,
            'searchModelRealisasi' => $searchModelRealisasi,
            'dataProviderRealisasi' => $dataProviderRealisasi,
            'searchModelLaporan' => $searchModelLaporan,
            'dataProviderLaporan' => $dataProviderLaporan,
        ]);
    }

    /**
     * Creates a new TProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TProject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data Berhasil disimpan.");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TProject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->start_date = date('Y-m-d', strtotime($model->start_date));
        $model->finish_date = date('Y-m-d', strtotime($model->finish_date));
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data Berhasil diubah.");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TProject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TProject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TProject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TProject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
