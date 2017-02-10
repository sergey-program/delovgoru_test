<?php

namespace app\controllers;

use app\components\DateFilter;
use app\controllers\extend\AbstractController;
use app\models\Notice;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * Class NoticeController
 *
 * @package app\controllers
 */
class NoticeController extends AbstractController
{
    /**
     * @param null|int $y
     * @param null|int $m
     *
     * @return string
     */
    public function actionIndex($y = null, $m = null)
    {
        $dateFilter = new DateFilter($y, $m);
        $query = Notice::find()
            ->where('MONTH(oncreate) = "' . $dateFilter->m . '" ')
            ->andWhere('YEAR(oncreate) = "' . $dateFilter->y . '"');

        $dataProvider = new ActiveDataProvider(['query' => $query, 'pagination' => ['defaultPageSize' => 2]]);

        $notice = new Notice();

        return $this->render('index', [
            'notice' => $notice,
            'dataProvider' => $dataProvider,
            'dateFilter' => $dateFilter
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $notice = new Notice();

        if (\Yii::$app->request->isPost && $notice->load(\Yii::$app->request->post())) {
            if ($notice->save()) {
                \Yii::$app->session->setFlash('notice-create', 'success:Уведомление успешно добавлено. ' . \Yii::$app->formatter->asDate($notice->oncreate, 'php:Y-m-d'));
            } else {
                \Yii::$app->session->setFlash('notice-create', 'danger:Произошла ошибка при добавлении.');
            }
        }

        return $this->redirect(['notice/index']);
    }

    /**
     * @param int $id
     *
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $y = null;
        $m = null;
        $notice = Notice::findOne($id);

        if ($notice) {
            $y = date('Y', strtotime($notice->oncreate));
            $m = date('m', strtotime($notice->oncreate));

            $notice->delete();
        }

        return $this->redirect(['index', 'y' => $y, 'm' => $m]);
    }
}