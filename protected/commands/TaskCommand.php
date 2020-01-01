<?php


class TaskCommand extends CConsoleCommand
{

    public function actionIndex(){
        echo "working \n";
    }

    public function actionRepeatTransactions(){
        $rTrans = RepeatTransaction::model()->findAllByAttributes(['id'=>5]);
        foreach ($rTrans as $repeat){
            $transaction = Transaction::model()->findByPk($repeat->transaction_id);
            $newTransaction = new Transaction();
            $newTransaction->trans_date = $repeat->upcoming_date;
            $newTransaction->amount = $transaction->amount;
            $newTransaction->description = $transaction->description;
            $newTransaction->category = $transaction->category;
            $newTransaction->account_id = $transaction->account_id;
            $newTransaction->type = $transaction->type;
            if($newTransaction->save()){
                $repeat->setCurrentUpComingDate();
                $repeat->update();
            }
        }
    }
}
