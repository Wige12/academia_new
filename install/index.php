<?php

    $step = (isset($_GET['step'])) ? (int) $_GET['step'] : null;

    //Quantidade de etapas que seu instalador irá ter.
    $qntEtapas = 3;

    if (empty($step) || $step > $qntEtapas) {
        header('Location: ./?step=1');
    }

    //Crie uma pasta chamada step e dentro dela, coloque as páginas seguindo o modelo: pagina-1.php pagina-2.php pagina-3.php, conforme a quantidade de etapas.
    require_once 'pagina-' . $step . '.php';
    ?>