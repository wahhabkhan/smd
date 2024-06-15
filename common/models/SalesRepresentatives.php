<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_representatives".
 *
 * @property int $rep_id
 * @property string|null $contact_number
 * @property string|null $region
 * @property int $id
 *
 * @property Feedback[] $feedbacks
 * @property Users $id0
 * @property SalesAchieved[] $salesAchieveds
 * @property SalesDetails[] $salesDetails
 * @property SalesTargets[] $salesTargets
 * 
 */

 
class SalesRepresentatives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_representatives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['contact_number', 'region'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rep_id' => 'Rep ID',
            'contact_number' => 'Contact Number',
            'region' => 'Region',
            'id' => 'User',
        ];
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['rep_id' => 'rep_id']);
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Users::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[SalesAchieveds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesAchieveds()
    {
        return $this->hasMany(SalesAchieved::class, ['rep_id' => 'rep_id']);
    }

    /**
     * Gets query for [[SalesDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDetails()
    {
        return $this->hasMany(SalesDetails::class, ['rep_id' => 'rep_id']);
    }

    /**
     * Gets query for [[SalesTargets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesTargets()
    {
        return $this->hasMany(SalesTargets::class, ['rep_id' => 'rep_id']);
    }

    public function getUser()
{
    return $this->hasOne(Users::className(), ['id' => 'id']);
}
}
