<?php
header( 'content-type: text/html; charset=utf-8' );
ini_set('display_errors', '1');
error_reporting(-1);
set_time_limit(0);

$conf = include( dirname(__FILE__)."/conf.php" );
include( dirname(dirname(__FILE__))."/Teinte/Build.php" );

?>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Administration, Discours sur la danse, OBVIL</title>
    <link rel="stylesheet" type="text/css" href="../Teinte/tei2html.css" />
    <style> #center { padding: 1em; } </style>
  </head>
  <body>
    <div id="center">
      <h1><a href="pull.php">Administration</a>, <a href="." target="_blank"><?= $conf['title'] ?></a></h1>
      <form method="POST">
        <label>Mot de passe
          <input name="pass" type="password"/>
        </label>
        <button name="up" type="submit">Mettre à jour</button>
        <label>Forcer
          <input name="force" type="checkbox"/>
        </label>
      </form>
      <section>
      <?php
  if ( !isset( $_POST['pass'] ));
  else if ( $_POST['pass'] != $conf['pass'] ) {
    echo "Mauvais mot de passe";
  }
  else {
    $getcwd = getcwd();
    chdir( $conf['srcdir']  );
    echo 'Mise à jour distante <pre>'."\n";
    // $last = exec( $conf['cmdup'], $output, $ret);
    // echo implode( "\n", $output);
    passthru( $conf['cmdup'] );
    chdir( $getcwd );
    echo '</pre>'."\n";
    // envoyer le csv au build
    echo 'Transformations <pre style="white-space: pre-wrap;">'."\n";
    $build = new Teinte_Build( $conf );
    if ( isset($_POST['force']) && $_POST['force'] ) $build->clean();
    $build->glob( );
    echo '</pre>'."\n";
  }

      ?>
      </section>
    </div>
  </body>
</html>
