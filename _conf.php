<?php
return array(
  "title" => 'Góngora', // Nom du corpus
  "srcdir" => dirname( __FILE__ ), // dossier source depuis lequel exécuter la commande de mise à jour
  "cmdup" => "git submodule foreach git pull origin gh-pages 2>&1", // entrepôt avec modules
  "pass" => null, // Mot de passe à renseigner à l’installation
  "srcglob" => array( "polemos/*.xml", "gongoraobra/gongora_obra-poetica.xml" ), // pour mise à jour de la polémique
  "sqlite" => "polemos.sqlite", // nom de la base avec les métadonnées
  "destdir" => ".", // dossier de base où écrire les fichiers produits
  "formats" => "article, toc, epub, kindle", // formats à générer
);
?>
