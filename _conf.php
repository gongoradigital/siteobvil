<?php
return array(
  "title" => 'Góngora', // Nom du corpus
  "srcdir" => dirname( __FILE__ ), // dossier source depuis lequel exécuter la commande de mise à jour
  "cmdup" => "git submodule foreach git pull origin gh-pages 2>&1",
  "pass" => null, // Mot de passe à renseigner à l’installation
  "srcglob" => array( "polemos/*.xml" ), // pour mise à jour de la polémique
  "sqlite" => "polemos.sqlite", // pour les métadonnées de la polémique
  "destdir" => ".", // dossier de base depuis lequel produire les formats ex: ./article/doc_art.html
  "formats" => "article, toc, epub, kindle", // formats à générer
);
?>
