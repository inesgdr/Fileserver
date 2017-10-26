<?php
function explorer($chemin){
    $lstat    = lstat($chemin);
    $mtime    = date('d/m/Y H:i:s', $lstat['mtime']);
    $filetype = filetype($chemin);

    $perms = fileperms($chemin);

if (($perms & 0xC000) == 0xC000) {
    // Socket
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Lien symbolique
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Régulier
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Block special
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Dossier
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Caractère spécial
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // pipe FIFO
    $info = 'p';
} else {
    // Inconnu
    $info = 'u';
}

// Autres
$info .= (($perms & 0x0100) ? 'read ' : '-');
$info .= (($perms & 0x0080) ? 'write ' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Groupe
$info .= (($perms & 0x0020) ? 'read ' : '-');
$info .= (($perms & 0x0010) ? 'write ' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// Tout le monde
$info .= (($perms & 0x0004) ? 'read ' : '-');
$info .= (($perms & 0x0002) ? 'write ' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

//echo $info;
    
     
    // Affichage des infos sur le fichier $chemin
   // echo "$chemin   type: $filetype size: $lstat[size]  mtime: $mtime\n droit: $info   ";
    echo "Nom : $filetype taille : $lstat permission : $info ";
   // echo $fileperms;
     
    // Si $chemin est un dossier => on appelle la fonction explorer() pour chaque élément (fichier ou dossier) du dossier$chemin
    if( is_dir($chemin) ){
        $me = opendir($chemin);
        while( $child = readdir($me) ){
            if( $child != '.' && $child != '..' ){
                explorer( $chemin.DIRECTORY_SEPARATOR.$child );
            }
        }
    }
}
 
header('Content-type: text/html');
explorer(dirname(__FILE__));
?>
