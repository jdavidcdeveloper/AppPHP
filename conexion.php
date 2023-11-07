<?php

class conexion
{
    private $server = "localhost";
    private $user = "root";
    private $password = "";
    private $conexion;

    public function __construct()
    {
        try {

            $this->conexion = new PDO("mysql:host=$this->server;dbname=album", $this->user, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "failed conexion" . $e;
        }
    }

    public function ejecutar($sql)
    {
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }


    public function consultar($sql)
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}
