<?php

$pdo = new PDO('mysql:host=localhost;dbname=fitnessmanagement', 'root', 'root');

$Reponse=array ();

if (isset ($_REQUEST["mail"]) && isset($_REQUEST ["password"]) )
{


    $password=$_REQUEST["password"];
    $mail= $_REQUEST["mail"];
    $key = "isimsforthewin";
    $firstname = $_REQUEST["firstname"];
    //$firstname = fnEncrypt($_REQUEST["firstname"],"mabite");
    $lastname = $_REQUEST["lastname"];
    $phone = $_REQUEST["phone"];
    $localisation = $_REQUEST["localisation"];



        $sql = $pdo->query("SELECT * FROM  clients  WHERE email='$mail'");

        $row = $sql->fetch();
        // Si $row = false , l'utilisateur n'existe pas encore
        if ($row == false) {
            $pdo->exec("INSERT INTO clients (firstname,lastname,email,password,phone,localisation) VALUES('$firstname','$lastname','$mail','$password','$phone','$localisation')");
            $Reponse["Etat"] = "OK";
			mkdir('picture/'.$mail, 0777, true);
			copy('profile.jpeg','picture/'.$mail.'/profile.jpeg');


        } else {
            $Reponse["Etat"] = "NOK";
        }




    $output[] = $Reponse;
    print(json_encode($output));

}






