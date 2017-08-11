<?php

namespace app\controllers;

use Yii;
use app\models\Tercero;
use app\models\TerceroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TerceroController implements the CRUD actions for Tercero model.
 */
class TerceroController extends Controller
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
     * Lists all Tercero models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE") return $this->redirect(\yii\helpers\Url::base());
        $searchModel = new TerceroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tercero model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE") return $this->redirect(\yii\helpers\Url::base());
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tercero model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE") return $this->redirect(\yii\helpers\Url::base());
        $model = new Tercero();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtercero]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tercero model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE") return $this->redirect(\yii\helpers\Url::base());
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtercero]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tercero model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE") return $this->redirect(\yii\helpers\Url::base());
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
     * Finds the Tercero model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tercero the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tercero::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
