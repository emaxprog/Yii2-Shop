<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)
        ], $tableOptions);

        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string(64)
        ], $tableOptions);

        $this->createIndex(
            'idx-region-country_id',
            'region',
            'country_id'
        );

        $this->addForeignKey(
            'fk-region-country_id',
            'region',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'name' => $this->string(64)
        ], $tableOptions);

        $this->createIndex(
            'idx-region-region_id',
            'city',
            'region_id'
        );

        $this->addForeignKey(
            'fk-region-region_id',
            'city',
            'region_id',
            'region',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string(32)->notNull(),
            'surname' => $this->string(64)->notNull(),
            'phone'=>$this->string(17)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'address' => $this->string()->notNull(),
            'postcode' => $this->integer(),
            'city_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-address-user_id',
            'address',
            'user_id'
        );

        $this->addForeignKey(
            'fk-address-user_id',
            'address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-address-city_id',
            'address',
            'city_id'
        );

        $this->addForeignKey(
            'fk-address-city_id',
            'address',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%address}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%city}}');
        $this->dropTable('{{%region}}');
        $this->dropTable('{{%country}}');
    }
}
