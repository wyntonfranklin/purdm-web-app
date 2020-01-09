# wf Expenses

Notes

The database columns are
* transaction_id
* trans_date
* amount
* description
* category
* account_id
* type


Events

* wf.datetimepicker.onchange - on date picker changes
* wf.transaction.created - on transaction created


Cron Commands

Test task
```bash
*/1 * * * * php /home/shady/Documents/websites/wfexpenses/protected/yiic.php task crontest
```

Run every day at 3 30 to test this
```bash
30 3 * * * php /home/shady/Documents/websites/wfexpenses/protected/yiic.php task crontest
```
