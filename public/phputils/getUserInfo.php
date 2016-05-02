<?php


$pdo = new PDO('mysql:host=localhost;dbname=fitnessmanagement', 'root', 'root');

$Reponse=array ();

if (isset ($_REQUEST["email"]))
{

    $email= $_REQUEST["email"];
    $sql = $pdo->query("SELECT * FROM  clients  WHERE email='$mail'");
    $row = $sql->fetch();// Si $row = false , l'utilisateur n'existe pas encore

    $client =  \App\Client::all();
    var_dump($client);




    $output[] = $Reponse;
    print(json_encode($output));

}
$client =  \App\Client::all()->get(0);
var_dump($client);
?>