<?php

use yii\db\Migration;

/**
 * Class m230820_155331_rbac
 */
class m230820_155331_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230820_155331_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230820_155331_rbac cannot be reverted.\n";

        return false;
    }
    */
}
