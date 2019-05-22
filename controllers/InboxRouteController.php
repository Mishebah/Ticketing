<?php

namespace app\controllers;

use Yii;
use app\models\InboxRoute;
use app\models\InboxRouteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\CoreUtils;
use app\components\PermissionUtils;
use yii\db\Expression;
use app\components\StatusCodes;
/**
 * InboxRouteController implements the CRUD actions for InboxRoute model.
 */
class InboxRouteController extends Controller
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
     * Lists all InboxRoute models.
     * @return mixed
     */
    public function actionIndex()
    {
						if(!PermissionUtils::checkModuleActionPermission("InMessages",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $searchModel = new InboxRouteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination = ['pageSize' => 100];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InboxRoute model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(!PermissionUtils::checkModuleActionPermission("InMessages",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the InboxRoute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InboxRoute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InboxRoute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
