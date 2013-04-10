UPDATE product SET quantity=0 WHERE pid="c000001";
UPDATE product SET quantity=FLOOR(RAND()*100) WHERE pid<>"c000001"; 
