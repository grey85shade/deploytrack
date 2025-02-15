<?php

class Record {

    private $archivo = '../data/registros.json';

    public function save($proyecto, $entorno, $version, $fecha, $cambio) {
        $registros = $this->cargarRegistros();
        $nuevoRegistro = [
            'proyecto' => $proyecto,
            'entorno' => $entorno,
            'version' => $version,
            'fecha' => $fecha,
            'changeLog' => $cambio,
        ];
        $registros[] = $nuevoRegistro;
        file_put_contents($this->archivo, json_encode($registros, JSON_PRETTY_PRINT));
    }

    public function delete($proyecto, $entorno, $version) {
        $registros = $this->cargarRegistros();
        $registrosFiltrados = array_filter($registros, function($registro) use ($proyecto, $entorno, $version) {
            return !($registro['proyecto'] === $proyecto && $registro['entorno'] === $entorno && $registro['version'] === $version);
        });
        file_put_contents($this->archivo, json_encode(array_values($registrosFiltrados), JSON_PRETTY_PRINT));
    }

    public function getAll() {
        $registros = $this->cargarRegistros();
        usort($registros, function($a, $b) {
            return strtotime($b['fecha']) - strtotime($a['fecha']);
        });
        return $registros;
    }

    public function getLatest($proyecto, $entorno) {
        $registros = $this->cargarRegistros();
        $registrosFiltrados = array_filter($registros, function($registro) use ($proyecto, $entorno) {
            return $registro['proyecto'] === $proyecto && $registro['entorno'] === $entorno;
        });
        usort($registrosFiltrados, function($a, $b) {
            return strtotime($b['fecha']) - strtotime($a['fecha']);
        });
        return $registrosFiltrados[0] ?? null;
    }

    private function cargarRegistros() {
        if (file_exists($this->archivo)) {
            $contenido = file_get_contents($this->archivo);
            $decoded = json_decode($contenido, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }
}