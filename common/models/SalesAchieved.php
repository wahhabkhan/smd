<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_achieved".
 *
 * @property int $sales_id
 * @property string|null $month_year
 * @property string|null $sales_achieved_amount
 * @property int $rep_id
 *
 * @property SalesRepresentatives $rep
 */
class SalesAchieved extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_achieved';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_id'], 'required'],
            [['rep_id'], 'integer'],
            [['month_year', 'sales_achieved_amount'], 'string', 'max' => 255],
            [['rep_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesRepresentatives::class, 'targetAttribute' => ['rep_id' => 'rep_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sales_id' => 'Sales ID',
            'month_year' => 'Month Year',
            'sales_achieved_amount' => 'Sales Achieved Amount (USD)',
            'rep_id' => 'Rep Name',
        ];
    }

    /**
     * Gets query for [[Rep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRep()
    {
        return $this->hasOne(SalesRepresentatives::class, ['rep_id' => 'rep_id']);
    }
    
    public function getSalesRepresentative()
    {
        return $this->hasOne(SalesRepresentatives::class, ['rep_id' => 'rep_id']);
    }

    // public static function getSalesData($monthYear)
    // {
    //     $salesAchievedData = self::find()
    //         ->select(['users.name AS rep_name', 'SUM(sales_achieved.sales_achieved_amount) as sales_achieved'])
    //         ->joinWith('salesRepresentative.user') // Assuming you have a relation named 'salesRepresentative' linking to 'SalesRepresentatives' and 'user' linking to 'User'
    //         ->where(['sales_achieved.month_year' => $monthYear])
    //         ->groupBy(['users.name'])
    //         ->asArray()
    //         ->all();

    //     return $salesAchievedData;
    // }

}
