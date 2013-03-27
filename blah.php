<?php
if (isset($_SESSION['email'])){
	echo "extra is: " . $_SESSION['email'];
}else{
	echo "Noooope !";
}
?>