<?php


class TaskCommand extends CConsoleCommand
{

    public function actionIndex(){
        echo "working \r\n";
    }

    public function actionRepeatTransactions(){

        echo "Running\r\n";
        $criteria = new CDbCriteria();
        $criteria->addCondition('upcoming_date <="'.date('Y-m-d').'"');
        echo $criteria->condition. "\r\n";
        $rTrans = RepeatTransaction::model()->findAll($criteria);
        foreach ($rTrans as $repeat){
            $transaction = Transaction::model()->findByPk($repeat->transaction_id);
            if($transaction != null ){
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
                    echo "Added \r\n";
                }
            }
        }
    }

    public function actionUpdateUserPassword($id, $password){
        $user = Users::model()->findByPk($id);
        $ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
            Yii::app()->params['phpass']['portable_hashes']);
        $user->password = $ph->HashPassword($password);
        if($user->update()){
            echo "update successfully\r\n";
        }else{
            echo $user->getHTMLErrorSummary();
        }
    }

    public function actionChangeUserAccess($id, $type){
        $user = Users::model()->findByPk($id);
        if($user !== null ){
            $user->userType = $type;
            if($user->update()){
                echo "User updated \r\n";
            }else{
                echo "An error occurred \r\n";
            }
        }else{
            echo "User not found \r\n";
        }
    }

    public function actionCronTest(){
        echo "yes" . "\n";
        $value = 'Ran at' . date('Y-m-d h:i:s');
        Utils::dbLogger('cron test',$value);
        //Utils::logger('Cron working','CRON');
    }

    public function actionCreateUser($name, $email, $password){
        $user = new Users();
        $user->username = $name;
        $user->email = $email;
        $user->createdAt = date("Y-m-d h:i:s");
        $ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
            Yii::app()->params['phpass']['portable_hashes']);
        $user->password = $ph->HashPassword($password);
        if($user->save()){
            echo "User Saved \r\n";
        }else{
            echo Utils::getErrorSummaryAsText(
                $user->getHTMLErrorSummary());
        }

    }


}
