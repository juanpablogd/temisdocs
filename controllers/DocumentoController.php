<?php

namespace app\controllers;

use Yii;
use app\models\Documento;
use app\models\DocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
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
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE" && Yii::$app->user->identity->perfil != "CONSULTA")  return $this->redirect(\yii\helpers\Url::base());

        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE" && Yii::$app->user->identity->perfil != "CONSULTA")  return $this->redirect(\yii\helpers\Url::base());

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE" && Yii::$app->user->identity->perfil != "CONSULTA")  return $this->redirect(\yii\helpers\Url::base());

        $model = new Documento();

        if ($model->load(Yii::$app->request->post())) {     //print_r($model);
            //GUARDA ARCHIVO EN EL SERVIDOR
            $nombreArchivo = $model->tercero_idtercero."_".$model->tipodoc_idtipodoc; //echo " asdfasd: ".$nombreArchivo;
            $directorio = 'uploads/'.$model->tercero_idtercero;
            @mkdir($directorio, 0777, true);
            $model->file = UploadedFile::getInstance($model,'file');
            $model->file->saveAs($directorio."/".$nombreArchivo.'.'.$model->file->extension);   //
            //ALMACENA NOMBRE DE ARCHIVO
            $model->ruta = $directorio."/".$nombreArchivo.'.'.$model->file->extension;

            //FECHA Y HORA DEL SISTEMA
            $model->fechasis = date('Y-m-d H:i:s');
            //USUARIO QUE INGRESA LA INFORMACIÓN
            $model->usuario_idusuario = Yii::$app->user->identity->id;
            //GUARDAR
            $model->save();
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->redirect(['view', 'id' => $id]);

        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE" && Yii::$app->user->identity->perfil != "CONSULTA")  return $this->redirect(\yii\helpers\Url::base());

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iddocumento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Documento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->perfil != "ADMIN" && Yii::$app->user->identity->perfil != "CARGUE" && Yii::$app->user->identity->perfil != "CONSULTA")  return $this->redirect(\yii\helpers\Url::base());
        
        $myDoc = $this->findModel($id);
        // Try to delete the file. If we can't then throw an Exception
        @unlink($myDoc->ruta);
        $myDoc->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
