<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property string|null $product_name
 * @property string|null $price
 *
 * @property SalesDetails[] $salesDetails
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'price'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'price' => 'Price (USD)',
        ];
    }

    /**
     * Gets query for [[SalesDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDetails()
    {
        return $this->hasMany(SalesDetails::class, ['product_id' => 'product_id']);
    }
    public function getSalesAchieved()
{
    // Assuming you have a foreign key in the product table pointing to sales_achieved
    return $this->hasMany(SalesAchieved::class, ['product_id' => 'product_id']);
}

}
