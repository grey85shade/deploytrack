<?php

class Record {

    private $archivo = '../data/registros.json';

    public function save($proyecto, $entorno, $version, $fecha, $cambio) {
        $registros = $this->cargarRegistros();
        $nuevoRegistro = [
            'id' => uniqid(),
            'proyecto' => $this->sanitizeInput($proyecto),
            'entorno' => $this->sanitizeInput($entorno),
            'version' => $this->sanitizeInput($version),
            'fecha' => $this->sanitizeInput($fecha),
            'changeLog' => $this->sanitizeInput($cambio),
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

    public static function getRecordById($id) {
        $records = json_decode(file_get_contents('data/registros.json'), true);
        foreach ($records as $record) {
            if ($record['id'] == $id) {
                return $record;
            }
        }
        return null;
    }

    public static function updateRecord($id, $data) {
        $records = json_decode(file_get_contents('data/registros.json'), true);
        foreach ($records as &$record) {
            if ($record['id'] == $id) {
                $record = array_merge($record, $data);
                file_put_contents('data/registros.json', json_encode($records, JSON_PRETTY_PRINT));
                return true;
            }
        }
        return false;
    }

    private function cargarRegistros() {
        if (file_exists($this->archivo)) {
            $contenido = file_get_contents($this->archivo);
            $decoded = json_decode($contenido, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    private function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}