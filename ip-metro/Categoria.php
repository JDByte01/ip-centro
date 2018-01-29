<?php 

require "Database.php";

class Categoria{
	function __construct(){

	}

	/**
	* 
	* @param $idCategoria identificador del registro
	* @return array datos del registro
	*/
	public static function getAll(){
		$consulta = "SELECT * FROM categoria";

		try {

			// Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);
			
		} catch (PDOException $e) {
			return false;
		}
	}


	/**
     * Obtiene los campos de una categoria con un identificador
     * determinado
     *
     * @param $idCategoria Identificador de la meta
     * @return mixed
     */
	public static function getById($idCategoria){
		//Consulta de la categoria
		$consulta = "SELECT id_categoria, nombre FROM categoria WHERE id_categoria = ?";

		try {
			// Preparar sentencia
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			// Ejecutar la sentencia preparada
			$comando->execute(array($idCategoria));
			// Capturar primera fila del resultado
			$row = $comando->fetch(PDO::FETCH_ASSOC);
			return $row; 

		} catch (PDOException $e) {
			//No seencontro en la DB
			return -1;
		}
	}

	/**
	* Actualizar un registro en la base de datos
	* en los nuevos valores relacionados con un identificador
	* @param $idCategoria 		identificador
	* @param nombre				nuevo nombre de categoria
	*/
	public static function update($idCategoria, $nombre){
		//Consulta update
		$consulta = "UPDATE categoria SET nombre = ? WHERE id_categoria = ?";
		//Preparar la consulta
		$cmd = Database::getInstance()->getDb()->prepare($consulta);
		//Relacionar y ejecutar la sentencia
		return $cmd->execute(array($nombre,$idCategoria));
	}

	/**
	* Insertar una nueva categoria
	*
	* @param nombre				nombre de la nueva categoria
	*/

   public static function insert($nombre){
   		//Consulta insert
   		$consulta = "INSERT INTO categoria (nombre) VALUES (?)";
   		//Preparar la consulta
   		$cmd = Database::getInstance()->getDb()->prepare($consulta);

   		return $cmd->execute(array($nombre));
   } 

   /**
   * Eliminar categoria
   *
   * @param $idCategoria 		Identificador de la categoria
   * @return boole 				respuesta de la eleminación
   */
   public static function delete($idCategoria){
   		//Sentencia delete
   		$sentencia = "DELETE FROM categoria WHERE id_categoria = ?";
   		//Preparar la sentencia
   		$cmd = Database::getInstance()->getDb()->prepare($sentencia);

   		return $cmd->execute(array($idCategoria));
   }
}
?>