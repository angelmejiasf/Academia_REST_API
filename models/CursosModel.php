<?php

require_once './db/db.php';

/**
 * Clase CursosModel
 *
 * Esta clase se encarga de interactuar con la base de datos para realizar operaciones relacionadas con los cursos.
 */
class CursosModel extends Basedatos {

    /**
     * @var Basedatos Objeto para interactuar con la base de datos.
     */
    private $db;

    /**
     * @var string Nombre de la tabla de cursos en la base de datos.
     */
    private $table;

    /**
     * Constructor de la clase CursosModel.
     */
    public function __construct() {
        $this->db = new Basedatos();
        $this->table = "cursos";
    }

    /**
     * Obtiene la información de un curso específico por su ID.
     *
     * @param int $idcurso ID del curso.
     * @return array|false Arreglo asociativo con la información del curso o false si no se encuentra.
     */
    public function obtenerCursoPorId($idcurso) {
        $query = "SELECT * FROM cursos WHERE idcurso = :idcurso";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->bindParam(':idcurso', $idcurso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene la información de todos los cursos.
     *
     * @return array Arreglo asociativo con la información de todos los cursos.
     */
    public function obtenerTodosLosCursos() {
        $query = "SELECT * FROM cursos";
        $stmt = $this->db->getConexion()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
