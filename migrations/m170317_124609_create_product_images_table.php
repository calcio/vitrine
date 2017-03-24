<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_images`.
 */
class m170317_124609_create_product_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_images', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_path' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-product_images-product_id',
            'product_images',
            'product_id'
        );

        $this->addForeignKey(
            'fk-product_images-product_id',
            'product_images',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_images');
    }
}
