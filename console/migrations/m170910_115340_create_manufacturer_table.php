<?php

use yii\db\Migration;

/**
 * Handles the creation of table `manufacturer`.
 * Has foreign keys to the tables:
 *
 * - `country`
 */
class m170910_115340_create_manufacturer_table extends Migration
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

        $this->createTable('manufacturer', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string(64)->notNull(),
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
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('manufacturer');
    }
}
