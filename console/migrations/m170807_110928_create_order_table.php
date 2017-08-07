<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `delivery`
 * - `payment`
 * - `status`
 */
class m170807_110928_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('delivery', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64),
            'price' => $this->smallInteger()
        ]);

        $this->createTable('payment', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64),
        ]);

        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
        ]);

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'delivery_id' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'comment' => $this->string(),
            'created_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-order-user_id',
            'order',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-user_id',
            'order',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `delivery_id`
        $this->createIndex(
            'idx-order-delivery_id',
            'order',
            'delivery_id'
        );

        // add foreign key for table `delivery`
        $this->addForeignKey(
            'fk-order-delivery_id',
            'order',
            'delivery_id',
            'delivery',
            'id',
            'CASCADE'
        );

        // creates index for column `payment_id`
        $this->createIndex(
            'idx-order-payment_id',
            'order',
            'payment_id'
        );

        // add foreign key for table `payment`
        $this->addForeignKey(
            'fk-order-payment_id',
            'order',
            'payment_id',
            'payment',
            'id',
            'CASCADE'
        );

        // creates index for column `status_id`
        $this->createIndex(
            'idx-order-status_id',
            'order',
            'status_id'
        );

        // add foreign key for table `status`
        $this->addForeignKey(
            'fk-order-status_id',
            'order',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );

        $this->createTable('order_product', [
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->smallInteger()->notNull()
        ]);

        $this->addPrimaryKey(
            'pk-order_product-order_id-product_id',
            'order_product',
            ['order_id', 'product_id']
        );

        // creates index for column `order_id`
        $this->createIndex(
            'idx-order_product-order_id',
            'order_product',
            'order_id'
        );

        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-order_product-order_id',
            'order_product',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-order_product-product_id',
            'order_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-order_product-product_id',
            'order_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_product');
        $this->dropTable('order');
        $this->dropTable('status');
        $this->dropTable('payment');
        $this->dropTable('delivery');
    }
}
