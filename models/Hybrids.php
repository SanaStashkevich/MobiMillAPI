<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Hybrids".
 *
 * @property int $id
 * @property string $Name
 * @property string $NameUa
 * @property string $Tagline
 * @property int $CulturesId
 * @property int $HybridsGroupId
 * @property string $Properties
 * @property int $New
 * @property string $Link
 * @property int $IsOld
 */
class Hybrids extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Hybrids';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'NameUa', 'Tagline', 'CulturesId', 'HybridsGroupId', 'Properties', 'New', 'Link'], 'required'],
            [['Tagline', 'Properties'], 'string'],
            [['CulturesId', 'HybridsGroupId', 'New', 'IsOld'], 'integer'],
            [['Name', 'NameUa'], 'string', 'max' => 40],
            [['Link'], 'string', 'max' => 255],
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
            'NameUa' => 'Name Ua',
            'Tagline' => 'Tagline',
            'CulturesId' => 'Cultures ID',
            'HybridsGroupId' => 'Hybrids Group ID',
            'Properties' => 'Properties',
            'New' => 'New',
            'Link' => 'Link',
            'IsOld' => 'Is Old',
        ];
    }

    public function getCulture()
    {
        return $this->hasOne(Cultures::class, ['id' => 'CulturesId']);
    }

    public function getCornHybrids()
    {
        return $this->hasMany(CornHybrids::class, ['HybridId' => 'id']);
    }
}
