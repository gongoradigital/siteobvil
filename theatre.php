<?php
$sqlite = "gongora_teatro.sqlite";
$dramagraph = '../Dramagraph/';

// $docid fixé par l’appeleur
include( $dramagraph.'Biblio.php');
include( $dramagraph.'Charline.php');
include( $dramagraph.'Net.php');
include( $dramagraph.'Table.php');



?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" charset="utf-8" type="text/css" href="../Teinte/tei2html.css"/>
    <link rel="stylesheet" charset="utf-8" type="text/css" href="<?php echo $dramagraph ?>dramagraph.css"/>
    <link rel="stylesheet" type="text/css" href="../theme/obvil.css" />
    <script src="<?php echo $dramagraph ?>sigma/sigma.min.js">//</script>
    <script src="<?php echo $dramagraph ?>sigma/sigma.layout.forceAtlas2.min.js">//</script>
    <script src="<?php echo $dramagraph ?>sigma/sigma.plugins.dragNodes.min.js">//</script>
    <script src="<?php echo $dramagraph ?>sigma/sigma.exporters.image.min.js">//</script>
    <script src="<?php echo $dramagraph ?>Rolenet.js">//</script>
    <style>
div.graph { position: relative; height: 600px; }
    </style>
  </head>
  <body id="top">
    <div id="center">
      <header id="header">
        <h1><a href=".">Gongora</a></h1>
        <a class="logo" href="http://obvil.paris-sorbonne.fr/"><img class="logo" src="../theme/img/logo-obvil.png" alt="OBVIL"></a>
      </header>
      <div id="contenu">
        <aside id="aside">
          <?php
$pdo = new PDO('sqlite:'.$sqlite);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$play = $pdo->query("SELECT * FROM play WHERE code = ".$pdo->quote( $docid ))->fetch();

if ($play) {
  $qobj = $pdo->prepare("SELECT cont FROM object WHERE playcode = ? AND type = ?");
  $qobj->execute( array( $docid, 'charline' ) );
  echo  current( $qobj->fetch(PDO::FETCH_ASSOC)) ;
}
?>
    </aside>
    <div id="main">
    <div id="article">
<?php
if ($play) {
  echo '<h1>'.$play['author']."<br/>".$play['title'].'</h1>';
  echo '
<details>
  <summary>Graphe d’interlocution <i>(cliquez ici pour plus d’explications)</i></summary>
  <p>Ce graphe est généré automatiquement à partir du texte balisé de la pièce de théâtre. Chaque pastille est un personnage, dont la taille est proportionnelle à la quantité de paroles qui lui sont attribuées. Les flèches indiquent à qui s’adresse ces paroles. Le placement des pastilles résulte d’un algorithme automatique cherchant à éviter les croisements entre les flèches. Jouer avec les boutons ci-dessous, notamment le mélange aléatoire (♻) et la relance de l’algorithme (►), permet de mieux saisir ce qui est arbitraire, ou déterminé par le poids des paroles, dans la disposition relative des personnages. Les couleurs sont des convenances facilitant la lecture, elles résultent d’une combinatoire entre sexe, âge, et statut des personnages. Retrouvez <a href="#tables">ci-desssous</a> les tables de données avec lesquelles l’image est produite. Entre autres publications sur cet instrument, ce <a target="_blank" href="https://resultats.hypotheses.org/749">billet</a> donne des exemples d’interprétation.</p>
</details>
  ';
  echo Dramagraph_Net::graph( $pdo, $docid );
  echo '<p> </p>';
  $qobj->execute( array( $docid, 'article' ) );
  echo  current( $qobj->fetch(PDO::FETCH_ASSOC)) ;
  echo '<section class="page" id="tables"> <p> </p>';
  echo Dramagraph_Table::roles( $pdo, $docid );
  echo Dramagraph_Table::relations( $pdo, $docid );
  echo '</section>';
}
else {
  echo Dramagraph_Biblio::table( $pdo, null, "?play=%s");
}
 ?>
      </div>
    </div>
    <a id="gotop" href="#top">▲</a>
    <script type="text/javascript" src="http://oeuvres.github.io/Teinte/Sortable.js">//</script>
  </body>
</html>
