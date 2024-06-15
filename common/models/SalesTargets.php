<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "sales_targets".
 *
 * @property int $target_id
 * @property string|null $month_year
 * @property string|null $sales_target_amount
 * @property int $rep_id
 *
 * @property SalesRepresentatives $rep
 */
class SalesTargets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_targets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_id'], 'required'],
            [['rep_id'], 'integer'],
            [['month_year', 'sales_target_amount'], 'string', 'max' => 255],
            [['rep_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesRepresentatives::class, 'targetAttribute' => ['rep_id' => 'rep_id']],
        ];
    }

    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'target_id' => 'Target ID',
            'month_year' => 'Month Year',
            'sales_target_amount' => 'Sales Target Amount (USD)',
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

    // public static function getSalesData($monthYear)
    // {
    //     $salesTargetData = self::find()
    //         ->select(['users.name AS rep_name', 'SUM(sales_targets.sales_target_amount) as sales_target'])
    //         ->joinWith(['rep.user']) // Assuming you have a relation named 'rep' linking to 'SalesRepresentatives' and 'user' linking to 'Users'
    //         ->where(['sales_targets.month_year' => $monthYear])
    //         ->groupBy(['users.name'])
    //         ->asArray()
    //         ->all();
    
    //     return $salesTargetData;
    // }
    

    public static function getMonthYearDropdowns()
    {
        $monthYearData = self::find()
            ->select(['month_year'])
            ->distinct()
            ->orderBy(['month_year' => SORT_DESC])
            ->asArray()
            ->all();

        return ArrayHelper::map($monthYearData, 'month_year', 'month_year');
    }

    public static function getSalesRepresentativesDropdowns()
    {
        $representatives = SalesTargets::find()
            ->select(['sales_representatives.rep_id', 'users.name AS rep_name'])
            ->leftJoin('sales_representatives', 'sales_representatives.rep_id = sales_targets.rep_id')
            ->leftJoin('users', 'users.id = sales_representatives.id')
            ->distinct()
            ->orderBy(['rep_name' => SORT_ASC])
            ->asArray()
            ->all();
    
        return ArrayHelper::map($representatives, 'rep_id', 'rep_name');
    }
    
    
    


}
