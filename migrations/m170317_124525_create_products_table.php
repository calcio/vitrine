<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m170317_124525_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'cover' => $this->string(150),
            'price' => $this->decimal(10,2),
            'highligt' => $this->boolean()->notNull(),
            'status' => $this->boolean()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-products-category_id',
            'products',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-products-category_id',
            'products'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-products-category_id',
            'products'
        );

        $this->dropTable('products');
    }
}
