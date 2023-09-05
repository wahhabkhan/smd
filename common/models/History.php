<?php

namespace common\models;

use Yii;

class History extends \yii\db\ActiveRecord
{
    
    
    /**
     * {@inheritdoc}
     */
    public $Stakeholders = [];    
    public $stakeholderCategoryArray = [];
    public $stakeholder_ids;
    
    public static function tableName()
    {
        return 'giz_interventions_history';
    }

    public function getStakeholder()
    {
        return $this->hasOne(Stakeholder::class, ['stakeholder_id' => 'stakeholder_id']);
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['project_id' => 'project_id']);
    }

    public function getIntervention()
    {
        return $this->hasOne(Intervention::class, ['intervention_id' => 'intervention_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_of_intervention', 'giz_intervention', 'focal_person', 'comments'], 'string', 'max' => 255],
            [['stakeholder_id', 'project_id', 'intervention_id'], 'integer'],
            [['stakeholder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stakeholder::class, 'targetAttribute' => ['stakeholder_id' => 'stakeholder_id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'project_id']],
            [['intervention_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intervention::class, 'targetAttribute' => ['intervention_id' => 'intervention_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'intervention_history_id' => 'Intervention History ID',
            'year_of_intervention' => 'Year of Intervention',
            'giz_intervention' => 'GIZ Intervention',
            'focal_person' => 'Focal Person / Contact Person at the time',
            'comments' => 'Specifics / Details / Comments',
            'stakeholder_id' => 'Stakeholder',
            'project_id' => 'Project',
            'intervention_id' => 'Intervention',
        ];
    }
    public static function getChartData($params=[])
    {
        $query = (new \yii\db\Query())
        ->select(['stakeholder.stakeholder_category as stakeholder_category','count(stakeholder.stakeholder_category) as count'])
        ->from(self::tableName())
        ->join('INNER JOIN', 'stakeholder', self::tableName() . '.stakeholder_id = stakeholder.stakeholder_id');

        $dbData = $query
        ->groupBy('stakeholder.stakeholder_category')
        ->all();
        
        $data=[];
        $label = [];
        foreach($dbData as $category)
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

    public static function getGridData($params)
    {
        $query = (new \yii\db\Query())
        ->from(self::tableName())
        ->join('INNER JOIN', 'stakeholder', self::tableName() . '.stakeholder_id = stakeholder.stakeholder_id');
        $query->where("1=1");
        foreach($params as $param)
        {
            $query->andWhere($param);
        }
        // var_dump($params);
        // exit();
        return $query->all();

    }
    
    public static function getCategoryDropdowns()
    {
       return  self::find()->select('giz_intervention')
       ->where(['!=','giz_intervention',''])
        ->groupBy('giz_intervention')
        ->asArray()->all();
    }
}
