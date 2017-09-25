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
$qobj = $pdo->prepare("SELECT cont FROM object WHERE playcode = ? AND type = ?");

if ( $docid ) {
  echo "<div><b>Índice</b> (pinche en los globos para llegar a la porción de texto correspondiente)</div>";
  echo Dramagraph_Charline::pannel( $pdo, array( "playcode"=>$docid, "rythm"=>false, "width"=>290 ) );
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

<summary>Gráfico de interlocución <i>(pinche aquí para una descripción más detallada)</i></summary>
<p>Este gráfico se genera de forma automática a partir de la codificación de la obra. Cada disco representa un personaje y su tamaño es proporcional al número de palabras que pronuncia. Las flechas indican a quien las dirige. La distribución de estos discos se basa en un algoritmo para evitar que se crucen las flechas. Los botones situados debajo del gráfico (♻ para mezclar los discos de forma aleatoria, ► para volver a aplicar el algoritmo), pueden ayudar a diferenciar lo que es arbitrario en la disposición relativa de los personajes y lo que, al contrario, viene determinado por la cantidad de las palabras. Los colores han sido elegidos convencionalmente para facilitar la lectura y resultan de una combinación entre género, edad y estatuto de los personajes. <a href="#tables">Abajo</a> encontrará las bases de datos en las que se basa esta imagen.</p>

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
