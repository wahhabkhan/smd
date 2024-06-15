<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_details".
 *
 * @property int $detail_id
 * @property int|null $quantity_sold
 * @property int $product_id
 * @property int $rep_id
 *
 * @property Product $product
 * @property SalesRepresentatives $rep
 */
class SalesDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity_sold', 'product_id', 'sales_id'], 'integer'],
            [['product_id', 'sales_id'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'product_id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesAchieved::class, 'targetAttribute' => ['sales_id' => 'sales_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detail_id' => 'Detail ID',
            'quantity_sold' => 'Quantity Sold',
            'product_id' => 'Product ID',
            'sales_id' => 'Sales ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }

    /**
     * Gets query for [[SalesAchieved]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesAchieved()
    {
        return $this->hasOne(SalesAchieved::class, ['sales_id' => 'sales_id']);
    }

}
