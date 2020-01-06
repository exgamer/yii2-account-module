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

    public function up()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'account_id' =>  $this->bigInteger()->notNull(),
            'payment_system_id' =>  $this->bigInteger()->notNull(),
            'payment_system_transaction_number' =>  $this->string(255),
            'sum' => $this->double(),
            'type' => $this->smallInteger()->notNull(),
            'currency' => $this->bigInteger()->notNull(),
            'description' => $this->string(255),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()") ),
        ]);
        $this->addIndex(['status']);
        $this->addIndex(['account_id']);
        $this->addIndex(['payment_system_id']);
        $this->addForeign('account_id', 'user_account','id');
        $this->addForeign('payment_system_id', 'payment_system','id');
    }
}
