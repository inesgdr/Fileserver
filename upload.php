<?php

$target_dir = "uploads/"; // dossier dans lequel sera uploadé le contenu
$target_file = $target_dir . basename($_FILES["file"]["name"]); // file parce que c'est le nom donné au contenu par le js de dropzone.
	var_dump($target_file);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file); // place le contenu uploadé dans le dossier.

//Il ne faut pas oublier de donner les droits, que ce soit a mon index.html (là ou se trouve le html du form), mais aussi a upload.php,
// mais aussi au dossier de réception (donc ici le uploads.php). Il me semble qu'il faut bien donner tous les droits (0777)
?>
