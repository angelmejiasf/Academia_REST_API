<?php

require_once './db/db.php';
require_once './models/AcademiasModel.php';

/**
 * Instanciación del modelo de Academias
 */
$academiasModel = new AcademiasModel();

/**
 * Establecimiento del tipo de contenido de la respuesta como JSON
 */
header("Content-type: application/json");

/**
 * Verificación del método de solicitud
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /**
     * Obtención de todas las academias y conversión a formato JSON
     */
    $res = $academiasModel->obtenerTodasLasAcademias();
    echo json_encode($res);
    exit();
}

/**
 * Respuesta de error en caso de método de solicitud incorrecto
 */
header("HTTP/1.1 400 Bad Request");
