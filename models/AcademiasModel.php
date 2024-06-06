<?php

require_once './db/db.php';

/**
 * Clase AcademiasModel
 *
 * Esta clase se encarga de interactuar con la base de datos para obtener información relacionada con las academias.
 */
class AcademiasModel extends Basedatos {

    /**
     * @var string Nombre de la tabla de academias en la base de datos.
     */
    private $table;

    /**
     * @var PDO|null Objeto de conexión a la base de datos.
     */
    private $conexion;

    /**
     * Constructor de la clase AcademiasModel.
     *
     * @throws Exception Si hay un error al conectar a la base de datos.
     */
    public function __construct() {
        $this->table = "academias";
        $this->conexion = $this->getConexion();

        if ($this->conexion === null) {
            throw new Exception("Error al conectar a la base de datos: " . $this->getMensajeError());
        }
    }

    /**
     * Obtiene todas las academias almacenadas en la base de datos.
     *
     * @return array|null Arreglo asociativo con la información de todas las academias, o null si no se encontraron registros.
     */
    public function obtenerTodasLasAcademias() {
        $conexion = $this->getConexion();
        $query = "SELECT * FROM academias";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $academiasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $academiasData;
    }
}

?>
