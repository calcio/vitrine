<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $cover
 * @property string $price
 * @property integer $highligt
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ProductImages[] $productImages
 * @property Categories $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'highligt', 'status', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'highligt', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['cover'], 'string', 'max' => 150],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'cover' => 'Cover',
            'price' => 'Price',
            'highligt' => 'Highligt',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
