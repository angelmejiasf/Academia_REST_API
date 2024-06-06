<?php

require_once './db/db.php';

/**
 * Clase AlumnosModel
 *
 * Esta clase se encarga de interactuar con la base de datos para realizar operaciones relacionadas con los alumnos.
 */
class AlumnosModel {

    /**
     * @var Basedatos Objeto para interactuar con la base de datos.
     */
    private $db;

    /**
     * @var string Nombre de la tabla de alumnos en la base de datos.
     */
    private $table;

    /**
     * Constructor de la clase AlumnosModel.
     */
    public function __construct() {
        $this->db = new Basedatos();
        $this->table = "alumnoscursos";
    }

    /**
     * Inserta un nuevo alumno en la base de datos.
     *
     * @param string $nombre Nombre del alumno.
     * @param string $email Correo electrónico del alumno.
     * @param int $idcurso ID del curso al que se va a asociar el alumno.
     * @return string Mensaje indicando el resultado de la operación.
     */
    public function insertarAlumno($nombre, $email, $idcurso) {
        try {
            // Verificar si el alumno ya está registrado en otro curso
            $query = "SELECT COUNT(*) FROM alumnoscursos WHERE email = ? AND idcurso != ?";
            $stmt = $this->db->getConexion()->prepare($query);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $idcurso);
            $stmt->execute();
            $rowCount = $stmt->fetchColumn();

            if ($rowCount > 0) {
                // Si rowCount > 0, significa que el alumno ya está registrado en otro curso
                return "<h2>ERROR: El alumno ya está registrado en otro curso</h2>";
            }

            // Si el alumno no está registrado en otro curso, proceder con la inserción
            $query = "INSERT INTO alumnoscursos (nombre, email, idcurso) VALUES (?, ?, ?)";
            $stmt = $this->db->getConexion()->prepare($query);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $idcurso);

            $num = $stmt->execute();

            if ($num) {
                return "<h2>REGISTRO INSERTADO CORRECTAMENTE</h2>";
            } else {
                return "<h2>ERROR: No se ha podido insertar el alumno</h2>";
            }
        } catch (PDOException $e) {
            return "<h2>ERROR: No se ha podido insertar</h2>";
        }
    }

    /**
     * Obtiene el conteo de alumnos por curso.
     *
     * @return array Arreglo asociativo donde las claves son los IDs de los cursos y los valores son los conteos de alumnos.
     */
    public function obtenerConteoAlumnosPorCurso() {
        $query = "SELECT idcurso, COUNT(*) as conteo FROM $this->table GROUP BY idcurso";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conteo = [];
        foreach ($resultados as $resultado) {
            $conteo[$resultado['idcurso']] = $resultado['conteo'];
        }
        return $conteo;
    }

    /**
     * Obtiene los alumnos asociados a un curso específico.
     *
     * @param int $idcurso ID del curso.
     * @return array Arreglo asociativo con la información de los alumnos asociados al curso.
     */
    public function obtenerAlumnosPorCurso($idcurso) {
        $query = "SELECT * FROM $this->table WHERE idcurso = ?";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->bindParam(1, $idcurso);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todos los alumnos almacenados en la base de datos.
     *
     * @return array Arreglo asociativo con la información de todos los alumnos.
     */
    public function obtenerTodosLosAlumnos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Borra un alumno de la base de datos.
     *
     * @param int $idalumno ID del alumno a borrar.
     * @return string Mensaje indicando el resultado de la operación.
     */
    public function borrarAlumno($idalumno) {
        $conexion = $this->db->getConexion();

        // Verificar si el alumno existe
        $query = "SELECT * FROM $this->table WHERE idalumno = :idalumno";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':idalumno', $idalumno, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se encontró el alumno
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($resultados)) {
            return "ERROR AL BORRAR. EL ALUMNO NO EXISTE";
        }

        // Borrar el alumno
        $query = "DELETE FROM $this->table WHERE idalumno = :idalumno";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':idalumno', $idalumno, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ALUMNO BORRADO CORRECTAMENTE";
        } else {
            return "ERROR AL BORRAR EL ALUMNO";
        }
    }
}

?>
