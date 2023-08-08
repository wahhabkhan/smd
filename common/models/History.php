<?php

namespace common\models;

use Yii;

class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            'focal_person' => 'Focal Person',
            'comments' => 'Comments',
            'stakeholder_id' => 'Stakeholder ID',
            'project_id' => 'Project ID',
            'intervention_id' => 'Intervention ID',
        ];
    }

}
