<?php

require_once './db/db.php';
require_once './models/CursosModel.php';

/**
 * Instanciación del modelo de Cursos
 */
$cursosModel = new CursosModel();

/**
 * Establecimiento del tipo de contenido de la respuesta como JSON
 */
header("Content-type: application/json");

/**
 * Manejo de solicitudes GET para obtener un curso por su ID
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
    $curso = $cursosModel->obtenerCursoPorId($idcurso);
    if ($curso) {
        echo json_encode($curso);
    } else {
        echo json_encode(['error' => 'Curso no encontrado']);
    }
    exit();
}

/**
 * Obtener todos los cursos si no se pasa idcurso (opcional)
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cursos = $cursosModel->obtenerTodosLosCursos();
    echo json_encode($cursos);
    exit();
}
?>
