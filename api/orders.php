<?php

/*
A method that gets the status of an order.  It should return the old date or a new "delayed" date.

POST /orders/:id
return = {
  "delivery_date": "2013-01-01"
}
*/

if (isset($_GET["id"])){
    echo "id=".$_GET["id"];
} else{
    // wrong call / 404 page..
}

echo "hello from products page";

?>