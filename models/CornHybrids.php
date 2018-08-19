<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CornHybrids".
 *
 * @property int $id
 * @property int $HybridId
 * @property int $FAOUnits
 * @property int $GrainTypeId
 * @property int $Water
 * @property int $DryResistant
 * @property int $MonoculturesCornId
 * @property int $MinimalProcessing
 * @property int $LateHarvest
 * @property int $SowingTimeId
 * @property string $Recommendation
 * @property int $HumidificationAndDensityId
 * @property int $ClimaZoneFitnessId
 * @property int $UsePolissya
 * @property int $UseLisostep
 * @property int $UseStep
 */
class CornHybrids extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CornHybrids';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['HybridId', 'FAOUnits', 'GrainTypeId', 'Water', 'DryResistant', 'MonoculturesCornId', 'MinimalProcessing', 'LateHarvest', 'SowingTimeId', 'Recommendation', 'HumidificationAndDensityId', 'ClimaZoneFitnessId', 'UsePolissya', 'UseLisostep', 'UseStep'], 'required'],
            [['HybridId', 'FAOUnits', 'GrainTypeId', 'Water', 'DryResistant', 'MonoculturesCornId', 'MinimalProcessing', 'LateHarvest', 'SowingTimeId', 'HumidificationAndDensityId', 'ClimaZoneFitnessId', 'UsePolissya', 'UseLisostep', 'UseStep'], 'integer'],
            [['Recommendation'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'HybridId' => 'Hybrid ID',
            'FAOUnits' => 'Faounits',
            'GrainTypeId' => 'Grain Type ID',
            'Water' => 'Water',
            'DryResistant' => 'Dry Resistant',
            'MonoculturesCornId' => 'Monocultures Corn ID',
            'MinimalProcessing' => 'Minimal Processing',
            'LateHarvest' => 'Late Harvest',
            'SowingTimeId' => 'Sowing Time ID',
            'Recommendation' => 'Recommendation',
            'HumidificationAndDensityId' => 'Humidification And Density ID',
            'ClimaZoneFitnessId' => 'Clima Zone Fitness ID',
            'UsePolissya' => 'Use Polissya',
            'UseLisostep' => 'Use Lisostep',
            'UseStep' => 'Use Step',
        ];
    }

    public function getHybrids()
    {
        return $this->hasOne(Hybrids::class, ['id' => 'HybridId']);
    }
}
