<?php

require_once './db/db.php';
require_once './models/AlumnosModel.php';

/**
 * Instanciación del modelo de Alumnos
 */
$alumnosModel = new AlumnosModel();

/**
 * Establecimiento del tipo de contenido de la respuesta como JSON
 */
header("Content-type: application/json");

/**
 * Manejo de solicitudes POST
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = json_decode(file_get_contents('php://input'), true);

    if (isset($post['nombre']) && isset($post['email']) && isset($post['idcurso'])) {
        $res = $alumnosModel->insertarAlumno($post['nombre'], $post['email'], $post['idcurso']);
        $resul = ['resultado' => $res];
        echo json_encode($resul);
    }

    exit();
}

/**
 * Manejo de solicitudes GET
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'contar') {
    $conteo = $alumnosModel->obtenerConteoAlumnosPorCurso();
    echo json_encode($conteo);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
    $alumnos = $alumnosModel->obtenerAlumnosPorCurso($idcurso);
    echo json_encode($alumnos);
    exit();
}

/**
 * Manejo de solicitudes DELETE
 */
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID del alumno a borrar
    $idalumno = $_GET['idalumno'];
    // Borrar el alumno de la base de datos
    $res = $alumnosModel->borraralumno($idalumno);
    $resul['resultado'] = $res;
    echo $resul['resultado'];
    exit();
}

// Si no se cumple ninguna de las condiciones anteriores, se responde con un error 405 Method Not Allowed
http_response_code(405); // Method Not Allowed
echo json_encode(['resultado' => 'Método no permitido']);
?>
