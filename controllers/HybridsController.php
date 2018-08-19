<?php
/**
 * Created by PhpStorm.
 * User: sana
 * Date: 18.08.18
 * Time: 17:00
 */

namespace app\controllers;


use app\models\CornHybrids;
use app\models\Cultures;
use app\models\Hybrids;
use yii\base\ErrorException;
use yii\rest\ActiveController;

class HybridsController extends ActiveController
{
    public $modelClass = 'app\models\Hybrids';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (\Yii::$app->request->get('outputType') === 'xml') {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        }

        $culturesID = \Yii::$app->request->get('culturesID');
        if ($culturesID) {
            return  $this->loadHybridsByCultureId($culturesID);
        }

        $FAOUnits = \Yii::$app->request->get('FAOUnits');
        if ($FAOUnits) {
//            $FAOArray = explode(',',$FAOUnits);
//            $cornHybrids = CornHybrids::find()->where(['between', 'FAOUnits', $FAOArray[0], $FAOArray[1]])->asArray()->select('HybridId')->all();
//            return Hybrids::findAll(['id' => array_column($cornHybrids,'HybridId')]);

            return $this->loadHybridsByFAOUnit($FAOUnits);
        }

        return empty(\Yii::$app->request->get())
            ? Hybrids::find()->all()
            : ['error' =>'Not valid URL'];
    }

    private function loadHybridsByCultureId($id)
    {
        if (intval($id) < 0) {
            return ['error' => 'Not valid ID'];
        }

        try {
            $result = Cultures::findOne(['id' => $id])->hybrids;
        }
        catch (ErrorException $e) {
            $result = [];
        }

        return empty($result) ? ['data' => 'Data not found'] : $result;
    }

    private function loadHybridsByFAOUnit($fao)
    {
        $FAOArray = explode(',',$fao);
        if (count($FAOArray) < 2) {
            return ['error' => 'Not valid FAOUnits'];
        }

        try {
            $cornHybrids = CornHybrids::find()->with('hybrids')->where(['between', 'FAOUnits', $FAOArray[0], $FAOArray[1]])->all();

            foreach ($cornHybrids as $cornHybrid) {
                $result[] = $cornHybrid->hybrids;
            }
        }
        catch (ErrorException $e) {
            $result = [];
        }

        return empty($result) ? ['data' => 'Data not found'] : $result;
    }
}