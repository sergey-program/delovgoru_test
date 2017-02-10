<?php

namespace app\controllers;

use app\controllers\extend\AbstractController;
use app\models\Notice;

class NoticeController extends AbstractController
{
    public $defaultAction = 'list';

    /**
     * @return string
     */
    public function actionList()
    {
        $notices = Notice::find()->all();

        return $this->render('list');
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $notice = new Notice();

        if (\Yii::$app->request->isPost && $notice->load(\Yii::$app->request->post())) {
            if ($notice->save()) {
                return $this->refresh();
            }
        }

        return $this->render('create', [
            'notice' => $notice
        ]);
    }

    public function actionDelete($id)
    {

    }
}