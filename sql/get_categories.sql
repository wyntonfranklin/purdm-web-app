SELECT total, category, (total/(SELECT SUM(amount) FROM transactions WHERE type="expense" 
AND Month(trans_date)=03 AND Year(trans_date)=2019 AND account_id=2) *100 as percentage FROM 
        ( SELECT sum(amount) as total, category, @total_tax as dividen from transactions Where type="expense" 
        AND Month(trans_date)=03 AND Year(trans_date)=2019 AND account_id=2group by category order by total desc
) t