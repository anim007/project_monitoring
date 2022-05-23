<?php

namespace app\controllers;

use Yii;
use app\models\apps\User;
use app\models\search\UserSearch;
use app\models\forms\SignupForm;
use app\models\apps\YUserRole;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $login_role_IDs = User::findOne(Yii::$app->user->identity->id)->yRoleIDs;
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if (!is_null($user)) {
                Yii::$app->session->setFlash('success', "Data User berhasil disimpan, silahkan menambah role user.");
                return $this->redirect(['update', 'id' => $user->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->aktif = $model->status == 0 ? 0 : 1;

        if ($model->load(Yii::$app->request->post())) {
            $model->status = $model->aktif == 0 ? 0 : 10;
            $postUserRole = Yii::$app->request->post('YUserRole', []);

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    $this->updateUserRole($postUserRole, $model);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Data User berhasil diubah.");
                    return $this->redirect('index');
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $ecx->getMessage());
                return $this->refresh();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User profile.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'profile';

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Data User berhasil diubah.");
            }
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'change-password';

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->validatePassword($model->old_password))
                $model->addError('old_password', 'Password yang Anda Masukkan Salah!');
            if ($model->new_password !== $model->re_password) {
                $model->addError('re_password', 'Password Tidak Sama!');
            }

            $model->setPassword($model->new_password);

            if (!$model->hasErrors() && $model->save()) {
                Yii::$app->session->setFlash('success', "Password berhasil diubah.");
            }
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = $model::STATUS_DELETED;
        $model->save();

        Yii::$app->session->setFlash('success', "Berhasil menon-aktifkan user.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function updateUserRole($postData, $model)
    {
        $dataIDs = $model->yUserRoleIDs;
        if (!empty($postData)) {
            foreach ($postData as $k => $v) {
                if (!empty($v['y_user_role_id']) && !is_null($v['y_user_role_id']) && $v['y_user_role_id'] != "") {
                    if (in_array($v['y_user_role_id'], $dataIDs)) {
                        unset($dataIDs[$k]);
                    }
                    $modelData = YUserRole::findOne($v['y_user_role_id']);
                    $modelData->y_user_id = $model->id;
                    $modelData->attributes = $v;
                    $modelData->update();
                } else {
                    $modelData = new YUserRole();
                    $modelData->y_user_id = $model->id;
                    $modelData->attributes = $v;
                    $modelData->insert();
                }
            }
        }
        //Delete transaksi => update aktif to 0
        if (!empty($dataIDs)) {
            $ids = implode(',', $dataIDs);
            YUserRole::deleteAll(
                'y_user_role_id IN (' . $ids . ')'
            );
        }
    }
}
