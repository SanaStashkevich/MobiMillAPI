<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Cultures".
 *
 * @property int $id
 * @property string $Name
 * @property int $MinDensity
 * @property int $MaxDensity
 * @property int $InSelector
 */
class Cultures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Cultures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'MinDensity', 'MaxDensity', 'InSelector'], 'required'],
            [['MinDensity', 'MaxDensity', 'InSelector'], 'integer'],
            [['Name'], 'string', 'max' => 17],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'MinDensity' => 'Min Density',
            'MaxDensity' => 'Max Density',
            'InSelector' => 'In Selector',
        ];
    }

    public function getHybrids()
    {
        return $this->hasMany(Hybrids::class, ['CulturesId' => 'id']);
    }
}
