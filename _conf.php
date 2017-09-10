<?php
return array(
  "srcdir" => dirname( __FILE__ ),
  "destdir" => ".",
  "cmdup" => "git submodule update --remote 2>&1",
  "pass" => null, // Mot de passe obligatoire
  "srcglob" => array( "polemos/*.xml", "gongora_obra-poetica.xml" ), // pour mise à jour de la polémique
  "sqlite" => "polemos.sqlite", // pour les métadonnées de la polémique
  "formats" => "article, toc, epub, kindle",
  "title" => 'Góngora',
);
?>
