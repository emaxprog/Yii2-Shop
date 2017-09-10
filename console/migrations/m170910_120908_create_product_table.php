<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `manufacturer`
 */
class m170910_120908_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'manufacturer_id' => $this->integer()->notNull(),
            'name' => $this->string(64)->notNull(),
            'alias' => $this->string(128)->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'code' => $this->integer()->notNull(),
            'is_new' => $this->boolean()->defaultValue(false),
            'is_recommended' => $this->boolean()->defaultValue(false),
            'visibility' => $this->boolean()->defaultValue(true),
            'amount' => $this->integer()->notNull(),
        ], $tableOptions);

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

        $this->createTable('{{%product_characteristic}}', [
            'product_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('pk-product_id_characteristic_id', '{{%product_characteristic}}', [
            'product_id',
            'characteristic_id'
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product_characteristic-product_id',
            '{{%product_characteristic}}',
            'product_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product_characteristic-product_id',
            '{{%product_characteristic}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `manufacturer_id`
        $this->createIndex(
            'idx-product_characteristic-characteristic_id',
            '{{%product_characteristic}}',
            'characteristic_id'
        );

        // add foreign key for table `manufacturer`
        $this->addForeignKey(
            'fk-product_characteristic-characteristic_id',
            '{{%product_characteristic}}',
            'characteristic_id',
            '{{%characteristic}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%product_characteristic}}');
        $this->dropTable('{{%product}}');
    }
}
