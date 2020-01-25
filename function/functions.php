<?php 
    require_once("db-connector.php");

    /**
     * Function that checkes if the user is logged-in
     */
    function checkUserLoggedIn(){
        if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
            return true;
        }
    }

?>