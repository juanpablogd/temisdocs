<?php

namespace app\controllers;

use Yii;
use app\models\Tipodoc;
use app\models\TipodocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipodocController implements the CRUD actions for Tipodoc model.
 */
class TipodocController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tipodoc models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        $searchModel = new TipodocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipodoc model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tipodoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        $model = new Tipodoc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipodoc]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tipodoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtipodoc]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tipodoc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        try {
            if($this->findModel($id)->delete()){
               return $this->redirect(['index']);
            }
         } catch (\Exception $e) {
            $msj = "Falló al eliminar el dato porque tiene documentos relacionados: ".$id;
            throw new \yii\web\HttpException(500,$msj, 405);
         }
    }

    /**
     * Finds the Tipodoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipodoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN") return $this->redirect(\yii\helpers\Url::base());
        if (($model = Tipodoc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
