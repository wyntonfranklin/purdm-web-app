 SELECT ( Ifnull(income, 0) - Ifnull(expense, 0) ) + (Ifnull(rAdd,0) - Ifnull(rMinus,0)) AS networth
FROM   (SELECT (SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "income"
                       AND account_id = 1) AS income,
               (SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "expense"
                       AND account_id = 1) AS expense,
               (
               SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "reconcile" AND category="add"
                       AND account_id = 1) AS rAdd,
				(SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "reconcile" AND category="minus"
                       AND account_id = 1) AS rMinus
        FROM   transactions
        GROUP  BY income) t  