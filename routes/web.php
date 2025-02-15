<?php

include '../App/Controllers/EngineController.php';

$controller = new engineController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $controller->eliminarRegistro($_POST['proyecto'], $_POST['entorno'], $_POST['version']);
    } else {
        $controller->saveRecord($_POST['proyecto'], $_POST['environment'], $_POST['version'], $_POST['date'], $_POST['changeLog']);
    }
}

$proOsiris = $controller->getPrePro('osiris', 'PRO');
$proIdcat = $controller->getPrePro('idcat', 'PRO');
$preOsiris = $controller->getPrePro('osiris', 'PRE');
$preIdcat = $controller->getPrePro('idcat', 'PRE');

$registros = $controller->mostrarRegistros();

include '../App/Views/index.php';