<?php
	
	
	$name = $_POST["name"];
	$image = $_POST["image"];
	$user = $_POST["user"];
	$decodeImage = base64_decode("$image");
	if (!file_exists('picture/'.$user)) {
    mkdir('picture/'.$user, 0777, true);
}
	
	file_put_contents("picture/".$user."/".$name.".JPG",$decodeImage);

?>