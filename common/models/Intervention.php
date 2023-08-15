<?php

namespace common\models;

use Yii;

class Intervention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'giz_intervention';
    }

    /**
     * {@inheritdoc}
     */

     public function rules()
     {
         return [
             [['name_of_intervention', 'short_description', 'giz_module', 'component_manager', 'comments'], 'string', 'max' => 255],
         ];
     }
 
     public function attributeLabels()
     {
         return [
             'intervention_id' => 'Intervention ID',
             'name_of_intervention' => 'Name of Intervention',
             'short_description' => 'Short Description of Intervention',
             'giz_module' => 'GIZ Project',
             'component_manager' => 'Component Manager + Technical Advisors',
             'comments' => 'Comments',
         ];
     }
}
