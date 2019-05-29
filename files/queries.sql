-- To view Cashiers
SELECT cashier_id,cashier_name,cashier_phone,CASHIER.username 
FROM CASHIER,ADMINISTRATOR 
WHERE CASHIER.admin_id = ADMINISTRATOR.admin_id AND ADMINISTRATOR.admin_id = 1;

-- To view Suppliers
SELECT supplier_id,supplier_name,supplier_phone 
FROM SUPPLIER,ADMINISTRATOR 
WHERE SUPPLIER.admin_id = ADMINISTRATOR.admin_id AND ADMINISTRATOR.admin_id = 1;

-- To view prescription
SELECT prescription_id,cust_fname,drug,drug_quantity,order_date
FROM PRESCRIPTION NATURAL JOIN CASHIER NATURAL JOIN CUSTOMER NATURAL JOIN STOCK
WHERE CASHIER.cashier_id = 1;

-- To view bills
SELECT invoice_no,supplier_name,cust_fname,cost,cust_address,bill_date 
FROM BILL NATURAL JOIN CUSTOMER NATURAL JOIN SUPPLIER NATURAL JOIN CASHIER 
WHERE CASHIER.cashier_id = 1;

-- To view wanted stocks
SELECT STOCK.stock_id,STOCK.quantity,SUM(drug_quantity)
FROM STOCK,PRESCRIPTION 
WHERE PRESCRIPTION.stock_id = STOCK.stock_id
GROUP BY STOCK.stock_id

-- To view cahier wise sales
SELECT CASHIER.cashier_name,SUM(BILL.cost) 
FROM BILL,CASHIER
WHERE BILL.cashier_id = CASHIER.cashier_id
GROUP BY CASHIER.cashier_id;