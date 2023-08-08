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
}
