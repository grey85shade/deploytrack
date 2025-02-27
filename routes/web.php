<?php

include '../App/Controllers/EngineController.php';

$controller = new EngineController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $controller->eliminarRegistro($_POST['proyecto'], $_POST['entorno'], $_POST['version']);
    } elseif (isset($_POST['update'])) {
        $controller->updateRecord();
        exit; // Asegúrate de que no se cargue el contenido HTML adicional
    } else {
        $controller->saveRecord($_POST['proyecto'], $_POST['environment'], $_POST['version'], $_POST['date'], $_POST['changeLog']);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $controller->getRecord($_GET['id']);
    exit; // Asegúrate de que no se cargue el contenido HTML adicional
}

$proOsiris = $controller->getPrePro('osiris', 'PRO');
$proIdcat = $controller->getPrePro('idcat', 'PRO');
$preOsiris = $controller->getPrePro('osiris', 'PRE');
$preIdcat = $controller->getPrePro('idcat', 'PRE');

$registros = $controller->mostrarRegistros();

include '../App/Views/index.php';
?>