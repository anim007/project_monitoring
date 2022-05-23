<?php

namespace app\controllers;

use Yii;
use app\models\apps\YRole;
use app\models\search\YRoleSearch;
use app\models\apps\YRoleMenu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for YRole model.
 */
class RoleController extends Controller
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
     * Lists all YRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YRole model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new YRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new YRole();
        $model->role_aktif = 1;

        if ($model->load(Yii::$app->request->post())) {
            $postRoleMenu = Yii::$app->request->post('YRoleMenu', []);
            if (empty($postRoleMenu)) {
                Yii::$app->session->setFlash('error', "Harap mengisi menu terlebih dahulu!");
                return $this->refresh();
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    $this->updateRoleMenu($postRoleMenu, $model);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Role berhasil disimpan!");
                    return $this->redirect('index');
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $ecx->getMessage());
                return $this->refresh();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing YRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $postRoleMenu = Yii::$app->request->post('YRoleMenu', []);
            if (empty($postRoleMenu)) {
                Yii::$app->session->setFlash('error', "Harap mengisi menu terlebih dahulu!");
                return $this->refresh();
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    $this->updateRoleMenu($postRoleMenu, $model);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Role berhasil diubah!");
                    return $this->redirect('index');
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $ecx->getMessage());
                return $this->refresh();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing YRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->role_aktif = 0;
        $model->save();

        Yii::$app->session->setFlash('success', "Berhasil menon-aktifkan role.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the YRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YRole::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function updateRoleMenu($postData, $model)
    {
        $dataIDs = $model->yRoleMenuIDs;
        if (!empty($postData)) {
            foreach ($postData as $k => $v) {
                if (!empty($v['id']) && !is_null($v['id']) && $v['id'] != "") {
                    if (in_array($v['id'], $dataIDs)) {
                        unset($dataIDs[$k]);
                    }
                    $modelData = YRoleMenu::findOne($v['id']);
                    $modelData->y_role_id = $model->y_role_id;
                    $modelData->attributes = $v;
                    $modelData->update();
                } else {
                    $modelData = new YRoleMenu();
                    $modelData->y_role_id = $model->y_role_id;
                    $modelData->attributes = $v;
                    $modelData->insert();
                }
            }
        }
        //Delete transaksi => update aktif to 0
        if (!empty($dataIDs)) {
            $ids = implode(',', $dataIDs);

            YRoleMenu::deleteAll(
                'id IN (' . $ids . ')'
            );
        }
    }
}
