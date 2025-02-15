<?php

include '../App/Models/Record.php';

class engineController {

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
}