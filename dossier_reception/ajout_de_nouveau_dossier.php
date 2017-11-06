<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="" method="post">
        <!-- Input où saura écrit le nom du new folder -->
        <input type="text" name="folder">
        <!-- Créer nouveau dossier -->
        <input type="submit" name="OK">
        <!-- Récuperer le nom du répertoire dans l'input  -->
    
        <!-- Création du répertoire sur le serveur -->

        
    </form>
        <?php 

        $folder = $_POST['folder'];

        

        mkdir('/home/htdocs/students/guerreti/grp3/dossier_reception/'.$folder, 0777);
        


       





        ?>
</body>
</html>