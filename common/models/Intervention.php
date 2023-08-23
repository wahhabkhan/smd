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

     public static function getGridData2($params)
     {
         $query = (new \yii\db\Query())
             ->from('giz_interventions_history')
             ->join('INNER JOIN', 'giz_intervention', 'giz_interventions_history.intervention_id = giz_intervention.intervention_id')
             ->join('INNER JOIN', 'stakeholder', 'giz_interventions_history.stakeholder_id = stakeholder.stakeholder_id') // Join with the stakeholder table
             ->select([
               //  'giz_intervention.year_of_intervention',
                 'giz_intervention.name_of_intervention',
                 'giz_intervention.short_description',
                 'giz_intervention.component_manager',
                 'giz_intervention.comments',
                 'stakeholder.organizational_location' 
             ]);
     
         $query->where("1=1");
         foreach ($params as $param) {
             $query->andWhere($param);
         }
         
         return $query->all();
     }
     
     
}
