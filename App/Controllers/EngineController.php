<?php

include '../App/Models/Record.php';

class EngineController {

    public function saveRecord($proyecto, $entorno, $version, $fecha, $cambio) {
        $record = new Record();
        $record->save($proyecto, $entorno, $version, $fecha, $cambio);
    }

    public function eliminarRegistro($proyecto, $entorno, $version) {
        $record = new Record();
        $record->delete($proyecto, $entorno, $version);
    }

    public function mostrarRegistros() {
        $record = new Record();
        return $record->getAll();
    }

    public function getPrePro($proyecto, $entorno) {
        $record = new Record();
        return $record->getLatest($proyecto, $entorno);
    }

    public function getRecord($id) {
        $records = json_decode(file_get_contents('../data/registros.json'), true);
        foreach ($records as $record) {
            if ($record['id'] == $id) {
                echo json_encode($record);
                return;
            }
        }
        echo json_encode(['error' => 'Record not found']);
    }

    public function updateRecord() {
        $id = $_POST['id'];
        $proyecto = $_POST['proyecto'];
        $entorno = $_POST['entorno'];
        $version = $_POST['version'];
        $fecha = $_POST['fecha'];
        $changeLog = $_POST['changeLog'];

        $records = json_decode(file_get_contents('../data/registros.json'), true);
        foreach ($records as &$record) {
            if ($record['id'] == $id) {
                $record['proyecto'] = $proyecto;
                $record['entorno'] = $entorno;
                $record['version'] = $version;
                $record['fecha'] = $fecha;
                $record['changeLog'] = $changeLog;
                break;
            }
        }
        file_put_contents('../data/registros.json', json_encode($records, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
    }
}
?>