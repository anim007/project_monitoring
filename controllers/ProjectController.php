<?php

namespace app\controllers;

use app\models\apps\TActivityDoc;
use Yii;
use app\models\apps\TProject;
use app\models\search\TActivityDocSearch;
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
        $user           = Yii::$app->user;
        $isPelaksana    = $user->isGuest ? false : array_search('Pelaksana', $user->identity->roles);
        
        $searchModel = new TProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($isPelaksana !== false) $dataProvider->query->andWhere(['pic_id' => $user->identity->m_bpartner_id]);

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
        $user           = Yii::$app->user;
        $isPelaksana    = $user->isGuest ? false : array_search('Pelaksana', $user->identity->roles);
        $userLoginID    = $user->identity->attributes['m_bpartner_id'];
        
        // var_dump($userLoginID); die();
        
        $model = $this->findModel($id);

        // echo $model->pic_id; die();
        
        if ($isPelaksana !== false){
            if($userLoginID != $model->pic_id){
                Yii::$app->session->setFlash('error', "Anda bukan penanggung jawab proyek tersebut.");
                return $this->redirect(['index']);
            }
        }

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

        $searchModelDoc = new TActivityDocSearch();
        $dataProviderDoc = $searchModelDoc->search(Yii::$app->request->queryParams);
        $dataProviderDoc->query->andWhere(['t_project_id' => $id]);

        return $this->render('view', [
            'model' => $model,
            'searchModelPerencanaan' => $searchModelPerencanaan,
            'dataProviderPerencanaan' => $dataProviderPerencanaan,
            'searchModelRealisasi' => $searchModelRealisasi,
            'dataProviderRealisasi' => $dataProviderRealisasi,
            'searchModelLaporan' => $searchModelLaporan,
            'dataProviderLaporan' => $dataProviderLaporan,
            'searchModelDoc' => $searchModelDoc,
            'dataProviderDoc' => $dataProviderDoc,
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
        $user           = Yii::$app->user;
        $isPelaksana    = $user->isGuest ? false : array_search('Pelaksana', $user->identity->roles);
        if ($isPelaksana !== false) $model->pic_id = $user->identity->m_bpartner_id;

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', "Data Berhasil disimpan.");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'isPelaksana' => $isPelaksana,
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
        $user           = Yii::$app->user;
        $isPelaksana    = $user->isGuest ? false : array_search('Pelaksana', $user->identity->roles);
        $userLoginID    = $user->identity->attributes['m_bpartner_id'];  

        $model = $this->findModel($id);
        $model->start_date = date('Y-m-d', strtotime($model->start_date));
        $model->finish_date = date('Y-m-d', strtotime($model->finish_date));

        if ($isPelaksana !== false){
            if($userLoginID != $model->pic_id){
                Yii::$app->session->setFlash('error', "Anda bukan penanggung jawab proyek tersebut.");
                return $this->redirect(['index']);
            }
        }
        
        if ($model->load(Yii::$app->request->post())  && $model->validate() && $model->save()) {
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
        $model = $this->findModel($id);

        if (!empty($model->tActivities) || !empty($model->tDailyReports)) {
            Yii::$app->session->setFlash('error', "Gagal menghapus project. Project ini sudah memiliki aktifitas!");
        } else {
            $model->delete();
            Yii::$app->session->setFlash('success', "Data Berhasil dihapus.");
        }

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
