<?php
use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191126_102340_account_operation
 */
class m191231_102340_account_operation extends Migration
{
    public function getTableName()
    {
        return 'account_operation';
    }

    public function safeUp()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'account_id' =>  $this->bigInteger()->notNull(),
            'payment_system_id' =>  $this->bigInteger()->notNull(),
            'payment_system_transaction_number' =>  $this->string(255),
            'payment_system_transaction_status' =>  $this->smallInteger(),
            'sum' => $this->double(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->string(255),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()") ),
        ]);
        $this->addIndex(['account_id']);
        $this->addIndex(['payment_system_id']);
        $this->addForeign('account_id', 'account','id');
        $this->addForeign('payment_system_id', 'payment_system','id');
    }
}
