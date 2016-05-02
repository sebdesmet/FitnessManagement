<?php


$pdo = new PDO('mysql:host=localhost;dbname=fitnessmanagement', 'root', 'root');

    $Reponse=array ();

    if (isset ($_REQUEST["pseudo"]) && isset($_REQUEST["password"]) ) {
        $login = $_REQUEST["pseudo"];
        $pass = $_REQUEST["password"];

        $sql = $pdo->query("SELECT password FROM  clients  WHERE email='$login'");
        $row = $sql->fetch();
        if ($row[0] == $pass) {
            $Reponse["Etat"] = "OK";
        } else {
            $Reponse["Etat"] = "NOK";
        }
        $output[] = $Reponse;
        print(json_encode($output));



}

