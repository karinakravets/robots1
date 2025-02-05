<?php

namespace app\controllers;

use app\models\Detail;
use app\models\Project;
use app\models\ProjectDetail;
use app\models\ProjectDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectDetailController implements the CRUD actions for ProjectDetail model.
 */
class ProjectDetailController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProjectDetail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectDetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectDetail model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->redirect(['delete', 'id' => $id]);
    }

    /**
     * Creates a new ProjectDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id, $missing = false)
    {
        $model = new ProjectDetail();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $detail = ProjectDetail::find()->where(['project_id' => $id, 'detail_id' => $model->detail_id])->andWhere('count' . ($missing ? '<' : '>') . '0')->one();
                if ($detail) {
                    $detail->count = abs($detail->count) + abs($model->count);
                    $detail->save();
                }
                else {
                    $model->save();
                }
                return $this->redirect(['project/view', 'id' => $id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'project' => Project::findOne($id),
            'missing' => $missing,
        ]);
    }

    /**
     * Updates an existing ProjectDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'project' => Project::findOne($model->project_id),
            'detail' => Detail::findOne($model->detail_id),
        ]);
    }

    /**
     * Deletes an existing ProjectDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProjectDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectDetail::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
