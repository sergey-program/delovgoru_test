<?php

namespace app\models;

use app\models\extend\AbstractActiveRecord;
use yii\base\InvalidParamException;

/**
 * Class Notice
 *
 * @package app\models
 *
 * @property int    $id
 * @property int    $oncreate
 * @property string $message
 */
class Notice extends AbstractActiveRecord
{
    /** @var int */
    public $cm;
    /** @var int */
    public $cy;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['cm', 'cy'], 'safe'],
            ['oncreate', 'default', 'value' => $this->assignRandomDate()],
            [['oncreate', 'message'], 'required']
        ];
    }

    /**
     * @return int
     */
    public function assignRandomDate()
    {
        try {
            $dateRange = \Yii::$app->params['noticeDateRange'];

            return date('Y-m-d H:i:s', mt_rand(strtotime($dateRange['min']), strtotime($dateRange['max'])));
        } catch (\Exception $exception) {
            throw new InvalidParamException('Notice Date Range not setuped in config.');
        }
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oncreate' => 'Дата создания',
            'message' => 'Текст уведомления'
        ];
    }
}