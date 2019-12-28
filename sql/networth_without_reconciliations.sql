 SELECT ( Ifnull(income, 0) - Ifnull(expense, 0) ) AS networth
FROM   (SELECT (SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "income"
                       AND account_id = 1) AS income,
               (SELECT Sum(amount)
                FROM   transactions
                WHERE  type = "expense"
                       AND account_id = 1) AS expense
        FROM   transactions
        GROUP  BY income) t
