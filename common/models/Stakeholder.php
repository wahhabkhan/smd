<?php

namespace common\models;

use Yii;

class Stakeholder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stakeholder';
    }

    /**
     * {@inheritdoc}
     */

     public function rules()
     {
         return [
             [['stakeholder_category', 'organization_name', 'legal_form', 
             'stakeholder_cat_specific_info', 'size', 'products', 'production_capacity', 
             'main_markets', 'brands', 'purchasing_capacity', 'main_purchasing_markets', 
             'main_sales_markets', 'suppling_factories', 'department', 'sub_category', 
             'organizational_location', 'objective', 'main_services', 'membership', 
             'giz_intervention_history'], 'string', 'max' => 255],           
         ];
     }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stakeholder_id' => 'ID',
            'stakeholder_category' => 'Stakeholder Category',
            'organization_name' => 'Organization Name',
            'legal_form' => 'Legal Form',
            'stakeholder_cat_specific_info' => 'Stakeholder Category Specific Information',
            'size' => 'Size',
            'products' => '(Main) Products',
            'production_capacity' => 'Production Capacity (Max. Output per Month)',
            'main_markets' => 'Main Markets (Countries, Regions)',
            'brands' => 'Brands (Current and History)',
            'purchasing_capacity' => 'Purchasing Capacity',
            'main_purchasing_markets' => 'Main Purchasing Markets',
            'main_sales_markets' => 'Main Sales Market',
            'suppling_factories' => 'Supplying Factories',
            'department' => 'Department',
            'sub_category' => 'Sub Category',
            'organizational_location' => 'Organization Location',
            'objective' => 'Objective',
            'main_services' => 'Main Services',
            'membership' => 'Membership',
            'giz_intervention_history' => 'Giz intervention History'

        ];
    }
    public static function getChartData($params=[])
    {
        $query = self::find()->select(['stakeholder_category','count(stakeholder_category) as count']);
        $query->where("1=1");
        foreach($params as $param)
        {
            $query->andWhere($param);
        }
        
        $stakeholderCategories = $query
            ->groupBy('stakeholder_category')
            ->asArray()->all();
        $data=[];
        $label = [];
        foreach($stakeholderCategories as $category)
        {
            $label[] = $category['stakeholder_category'];
            $data[] = $category['count'];
        }
        return new class($label,$data) {
            public $label;
            public $data = [
                
            ];
            public function __construct($label,$data=[]) {
                $this->label = $label;
                $this->data = $data;
            }
        };
    }
    public static function getLocationDropdowns()
    {
       return  self::find()->select('organizational_location')
       ->where(['!=','organizational_location',''])
        ->groupBy('organizational_location')
        ->asArray()->all();
    }

    public static function getCategoryCounts()
    {
        $stakeholders = self::find()->all();
        
        $categoryCounts = [
            'multiplier' => 0,
            'brand' => 0,
            'factory' => 0,
            'association' => 0,
            'government' => 0,
            // Add more categories if needed
        ];
        
        foreach ($stakeholders as $stakeholder) {
            if (isset($categoryCounts[$stakeholder->stakeholder_category])) {
                $categoryCounts[$stakeholder->stakeholder_category]++;
            }
        }
        
        return $categoryCounts;
    }
}
