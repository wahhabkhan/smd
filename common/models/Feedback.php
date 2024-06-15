<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $feedback_id
 * @property string|null $feedback_text
 * @property int $rep_id
 *
 * @property SalesRepresentatives $rep
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_id'], 'required'],
            [['rep_id'], 'integer'],
            [['feedback_text'], 'string', 'max' => 255],
            [['rep_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesRepresentatives::class, 'targetAttribute' => ['rep_id' => 'rep_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feedback_id' => 'Feedback ID',
            'feedback_text' => 'Feedback Text',
            'rep_id' => 'Rep ID',
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
}
