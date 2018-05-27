<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%products}}".
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
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE = 0;

    CONST STATUS_ACTIVE_STRING = 'Active';
    CONST STATUS_INACTIVE_STRING = 'Inactive';

    CONST STATUS_HIGHLIGHTED_STRING = 'Yes';
    CONST STATUS_UNHIGHLIGHTED_STRING = 'No';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'highligt', 'price', 'status'], 'required'],
            [['category_id', 'highligt', 'status'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['cover'], 'string', 'max' => 150],
            ['price', 'brazilianNumber'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function brazilianNumber($attribute, $params, $validator)
    {
        if (!preg_match("/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/", $this->$attribute)) {
            $this->addError($attribute, "\"{$attribute}\" must be a number.");
        }
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->price = $this->numberFormat($this->price);
            return true;
        } else {
            return false;
        }
    }

    public function numberFormat($value)
    {
        if ($value === '' || $value === null) {
            return $value;
        }

        $value = str_replace('.', '', $value);
        return (float) $value = str_replace(',', '.', $value);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'cover' => 'Image',
            'price' => 'Price',
            'highligt' => 'Highlight',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => TimestampBehavior::className(),
        ];
    }

    public function getStatusItems()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_STRING,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_STRING,
        ];
    }

    public function getStatusHighlighted()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_HIGHLIGHTED_STRING,
            self::STATUS_INACTIVE => self::STATUS_UNHIGHLIGHTED_STRING,
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
