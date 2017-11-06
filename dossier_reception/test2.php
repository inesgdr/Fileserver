<?php
    $racine = '/home/htdocs/students/guerreti/grp3/dossier_reception/';// dossier racine
    /*$imagedir = "./images";*/

    if ( ! is_dir($racine) )
    {
        echo "error de dossier racine";
        die();
    }

    $repertoire_actuel = $_GET['path'];//recup repertoir par l'url

     //////////////////////////////////////////////////////////////////////////////////////////////////////////
     //////////////////////////////////////////////////////////////////////////////////////////////////////////

                                            //Noms du dossier en cours sans garder l'historique

    // on tronque le debut si c'est un /
    if ( substr($repertoire_actuel,0,1) == "/" )
    {
        $repertoire_actuel = substr($repertoire_actuel,1,strlen($repertoire_actuel) - 1);
    }

    // si la fin de $repertoire_actuel = .. alors on retourne a la racine de ce dossier
    if ( substr($repertoire_actuel, strlen($repertoire_actuel) - 2, 2) == ".." )
    {
        // strip last /..
        $repertoire_actuel = substr($repertoire_actuel, 0, strlen($repertoire_actuel) - 3);

        // strip last /dirname
        $repertoire_actuel = substr($repertoire_actuel, 0, strrpos($repertoire_actuel,"/"));
    }

    // si la fin de $repertoire_actuel = /. alors on retourne a la racine de ce dossier
    if ( substr($repertoire_actuel, strlen($repertoire_actuel) - 2, 2) == "/." )
    {
        $repertoire_actuel = substr($repertoire_actuel, 0,strlen($repertoire_actuel) - 2);
    }

    // evite tout probleme de securite MAISempeche les nom de rep avec .. dedans
    $repertoire_actuel = str_replace("..", "", $repertoire_actuel);
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////

                                        //chemin .. pour naviger entre les dossier

    // on traite les actions spÃ©ciales
    $action = $_GET['action'];
    switch($action)
    {
        case "mkdir":
            if ( isset($_GET['arg'] ) )
            {
                // evite tout probleme de securite MAIS empeche les nom de rep avec .. dedans
                $mkdir = str_replace("..", "", $_GET['arg']);
                umask (0);
                mkdir($racine . "/" . $repertoire_actuel . "/" . $mkdir);
            }
            else
            {
                $affiche_creer_formulaire = true;

            }
            break;

        case "rm";
            if ( isset($_GET['confirmation'] ) )
            {
                // evite tout probleme de securite MAIS empeche les nom de rep avec .. dedans
                $rm = str_replace("..", "", $_GET['path']);

                if ( isset($_GET['file']) )
                    $rm = $rm . "/" . str_replace("..","", $_GET['file']) ;

                system("rm -r '". $racine . "/" . $rm . "'") ;
            }
            else
            {
                if( ! isset($_GET['infirmation']))
                    $affiche_supprimer_formulaire=true;

            }
            // si l'on ne supprimait pas un fichier (donc un rep, on doit retourner a la racine quelque soit la reponse
            if ( ( isset($_GET['confirmation']) || isset($_GET['infirmation']) ) && ! isset($_GET['file']) )
                // strip last /dirname pour retourner au parent du rep en cours
                $repertoire_actuel = substr($repertoire_actuel, 0, strrpos($repertoire_actuel,"/"));
            break;

    }
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////// //////////////////

    //////////recuperation des differentes caractéristiques/////////////

    $lstat    = lstat($chemin)['size'];
    $mtime    = date('d/m/Y H:i:s', lstat($chemin)['mtime']);
    $filetype = filetype($chemin);
    $name = basename($chemin); //fichier avec son extension

    $perms = fileperms($chemin);

//gestion permission des fichiers

$info="";

$info .= (($perms & 0x0100) ? 'read ' : '-');
$info .= (($perms & 0x0080) ? 'write ' : '-');

// Groupe
$info .= (($perms & 0x0020) ? 'read ' : '-');
$info .= (($perms & 0x0010) ? 'write ' : '-');


// Tout le monde
$info .= (($perms & 0x0004) ? 'read ' : '-');
$info .= (($perms & 0x0002) ? 'write ' : '-');

///////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////

                                    //html

?>

<html>
<head>
<title>
    Explorateur de fichier - /<?php echo $repertoire_actuel; ?>
</title>
</head>
<body>

<BIG><BIG>Explorateur - /<?php echo $repertoire_actuel; ?></BIG></BIG>

<table border=1 width=100%>

<tr>
<td valign=top width=20%>
    <!-- Colonne pour les repertoires -->

    <table border=0 width=100% height=100%>
    <tr><td colspan=3>
        <table border=1 width=100%>
        <tr>
        <td width=100%><b>Repertoires</b></td>
        </tr>
        </table>
    </td></tr>
    <?php
        $directory = opendir( $racine . "/" . $repertoire_actuel );
        while( $dir = readdir($directory) )
        {
            if (is_dir( $racine . "/" . $repertoire_actuel . "/" . $dir) && $dir != "." )
            {
                // on affiche pas le ..  quand on est a la racine
                if( $repertoire_actuel == "" && $dir != ".." || $repertoire_actuel != "")
                {
                    echo "<tr><td width=30 height=30>";
                    echo "<i class=' fa fa-folder-o fa-lg '></i>";
                    echo "</td><td width=80%>";
                    echo "<a href=\"" . $_self . "?path=" . urlencode($repertoire_actuel) . "/" . urlencode($dir) . "\">" . $dir . "</a>";
                    echo "</td><td align=right> ";
                    if ( $dir != ".." )
                        echo "<form method="post" action=""><button type="submit" name="submit" onclick="if(!confirm('Voulez-vous Supprimer')) return false;"><i class="fa fa-times" aria-hidden="true"></i>
                        </button></form>"; //fonction supprimer
                    echo "</td></tr>\n";
                }
            }
        }
        closedir($directory);


$path = "";
if(!unlink($path)){
    echo "Not deleted";
}
   else {
       echo "file deleted";
   }
    ;


    ?>
    </table>
</td>
<td valign=top width=80%>
    <!-- Colonne pour les fichiers -->

    <table border=0 width=100% height=100%>
    <tr><td colspan=3>
        <table border=1 width=100%>
        <tr>
        <td width="50%"><b>Noms</b></td>

        <td><b>Modifier</b></td>
        <td><b>Permission</b></td>
        <td><b>Supprimer</b></td>
        <td><b>Télecharger</b></td>
        <td><b>Taille</b></td>
        </tr>
        </table>
    </td></tr>
    <?php

        $directory = opendir( $racine . "/" . $repertoire_actuel );
        $foundone = false;
        while( $file = readdir($directory) )
        {
            if (is_file($racine . "/" . $repertoire_actuel . "/" . $file) )
            {
                $foundone = true;
                echo "<tr><td width=30 height=35>";

                // selon l'extension du fichier
                $ext = strtolower(substr($file,strrpos($file,".") + 1,strlen($file) - strrpos($file,".")));
                switch($ext)
                {

                        echo "<img width=30 height=28 src=\"miniature.php?gd=2&maxw=30&src=" . $racine . "/" . urlencode($repertoire_actuel) . "/" . urlencode($file) . "\"/>";
                        break;
                    default:
                        if ( is_file( $imagedir . "/" . $ext . ".gif" ) )
                            echo "<img width=30 height=28 src=\"miniature.php?gd=2&maxw=30&src=" . $imagedir . "/" . $ext . ".gif" . "\"/>";
                        else
                            echo strtoupper($ext);
                        break;
                }
                echo "</td><td>";
                echo "<a href=\"" . $racine . "/" . $repertoire_actuel . "/" . $file . "\">" . $file . "</a>";
                echo "</td><td align=right width=15%>";
                echo filesize($racine . "/" . $repertoire_actuel . "/" . $file );

                echo "</td></tr>\n";
            }
        }
        closedir($directory);
        if ( ! $foundone)
        {
            echo "<tr><td colspan=3 align=center><b>Aucun fichier !</b></td></tr>";
        }
    ?>

    </table>

</td>
</tr>
</table>
</body>
</html>
