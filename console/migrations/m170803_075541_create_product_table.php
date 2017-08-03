<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `manufacturer`
 */
class m170803_075541_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('manufacturer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'country_id' => $this->integer()->notNull()
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            'idx-manufacturer-country_id',
            'manufacturer',
            'country_id'
        );

        // add foreign key for table `country`
        $this->addForeignKey(
            'fk-manufacturer-country_id',
            'manufacturer',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'parent_id' => $this->integer()->notNull()->defaultValue(1),
            'sort' => $this->integer()->notNull()->defaultValue(1),
            'visibility' => $this->boolean()->defaultValue(true),
        ]);

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'manufacturer_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->unsigned()->notNull(),
            'code' => $this->integer()->unsigned()->notNull(),
            'is_new' => $this->boolean()->defaultValue(true),
            'is_recommended' => $this->boolean()->defaultValue(false),
            'is_popular' => $this->boolean()->defaultValue(false),
            'visibility' => $this->boolean()->defaultValue(true),
            'amount' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `manufacturer_id`
        $this->createIndex(
            'idx-product-manufacturer_id',
            'product',
            'manufacturer_id'
        );

        // add foreign key for table `manufacturer`
        $this->addForeignKey(
            'fk-product-manufacturer_id',
            'product',
            'manufacturer_id',
            'manufacturer',
            'id',
            'CASCADE'
        );

        $this->createTable('attribute', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'unit' => $this->string(16)->notNull()
        ]);

        $this->createTable('product_attribute', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value' => $this->string(64)->notNull()
        ]);

        $this->addPrimaryKey(
            'pk-product_attribute-product_id-attribute_id',
            'product_attribute',
            ['product_id', 'attribute_id']
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_attribute-product_id',
            'product_attribute',
            'product_id'
        );

        // add foreign key for table `product_attribute`
        $this->addForeignKey(
            'fk-product_attribute-product_id',
            'product_attribute',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `attribute_id`
        $this->createIndex(
            'idx-product_attribute-attribute_id',
            'product_attribute',
            'attribute_id'
        );

        // add foreign key for table `product_attribute`
        $this->addForeignKey(
            'fk-product_attribute-attribute_id',
            'product_attribute',
            'attribute_id',
            'attribute',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('product_attribute');
        $this->dropTable('attribute');
        $this->dropTable('product');
        $this->dropTable('category');
        $this->dropTable('manufacturer');
    }
}
