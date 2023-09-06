<?php

namespace common\models;

use Yii;

class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $start_date;
    public $end_date;
    public static function tableName()
    {
        return 'giz_project';
    }

     public function rules()
     {
         return [
             [['name_of_module', 'short_description', 'giz_intervention', 'duration', 'av', 'budget', 'comments'
             , 'start_date', 'end_date'], 'string', 'max' => 255],
         ];
     }
 
     public function attributeLabels()
     {
         return [
             'project_id' => 'Project ID',
             'name_of_module' => 'Name of Project',
             'short_description' => 'Short Description',
             'giz_intervention' => 'GIZ Intervention',
             'duration' => 'Duration',
             'av' => 'AV',
             'budget' => 'Budget',
             'comments' => 'Comments',
         ];
     }
}
