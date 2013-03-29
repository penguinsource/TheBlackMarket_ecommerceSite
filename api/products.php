<?php

if (isset($_GET["id"])){
    echo "id=".$_GET["id"];
} else if (isset($_POST["id"]) && isset($_POST["order"])){
    echo "ordering for id=".$_POST["id"];
} else{
    // return json with all products
}

echo "hello from products page";

?>