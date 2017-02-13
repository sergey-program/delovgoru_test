<?php

namespace app\controllers;

use app\components\DateFilter;
use app\controllers\extend\AbstractController;
use app\models\Notice;
use yii\data\ActiveDataProvider;

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

        // pagination can be setup (default Yii2 settings) in config
        $dataProvider = new ActiveDataProvider(['query' => $query]);

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
     * @return string
     */
    public function actionDelete($id)
    {
        // here should be isAjax condition, but in task wants isPost
        if (\Yii::$app->request->isPost) {
            $notice = $this->loadNotice($id);

            $y = $notice ? date('Y', strtotime($notice->oncreate)) : null;
            $m = $notice ? date('n', strtotime($notice->oncreate)) : null;

            $notice->delete();

            return $this->actionIndex($y, $m);
        }
    }
}