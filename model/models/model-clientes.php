<?php

class modeloCliente  extends BD{
//esta consulta carga todos los clientes de la base de datos
   public function consultarClientes() {
        return $this->ConsultaPreparada("SELECT *FROM clientes", array(1));
    }
//esta consulta carga  clientes con datos especificos de la base de datos
    function consultarClientesPorBusqueda($q){
    return $this->ConsultaPreparada("SELECT * FROM clientes WHERE
      rfc LIKE ? OR
      concat(apellidoPaterno,' ',apellidoMaterno,' ', nombre ) LIKE ? OR
      concat(nombre, ' ',apellidoPaterno,' ',apellidoMaterno) LIKE ? OR
      idCliente LIKE ?
      ORDER BY idCliente
      ",array("%$q%","%$q%","%$q%","%$q%"));
  }

  public function agregarCliente($rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
    $idDomicilio = (int) $this->ConsultaPreparada("SELECT MAX(idDomicilio) AS idDomicilio FROM domicilio", array(1))[0]['idDomicilio'] + 1;
      return $this->ConsultaPreparada
      ("INSERT INTO domicilio(idDomicilio, colonia, calle, codigoPostal, numeroExt, numeroInt)
        VALUES(?,?,?,?,?,?);
      INSERT INTO clientes(rfc, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, idEstado, idMunicipio, idLocalidad, idDomicilio)
          VALUES(?,?,?,?,?,?,?,?,?,?);}",
      array($idDomicilio, "$colonia",  "$calle", $codigoPostal, $numeroExt, $numeroInt, "$rfc","$nombre","$apellido","$apellido2","$telefono","$correo", $idEstado, $idMunicipio, $idLocalidad, $idDomicilio));
    }

    public function eliminarCliente($id){
      return $this->consultaPreparada(
        "DELETE FROM domicilio WHERE idDomicilio = (SELECT idDomicilio from clientes where idCliente = ?);
         DELETE FROM clientes   WHERE idCliente = ?", array("$id","$id"));
    }
    public function consultarCliente($id){
      return $this->ConsultaPreparada(
        "SELECT clientes.rfc, clientes.nombre, clientes.apellidoPaterno, clientes.apellidoMaterno, clientes.telefono,
                clientes.correo, clientes.idEstado, clientes.idMunicipio, clientes.idLocalidad,
                domicilio.colonia, domicilio.calle, domicilio.codigoPostal, domicilio.numeroExt, domicilio.numeroInt,
                estados.estado, municipios.municipio, localidades.localidad
        FROM ((((clientes INNER JOIN domicilio ON clientes.idDomicilio = domicilio.idDomicilio)
                          INNER JOIN estados ON clientes.idEstado = estados.idEstado)
                          INNER JOIN municipios ON clientes.idMunicipio = municipios.idMunicipio)
                          INNER JOIN localidades ON clientes.idLocalidad = localidades.idLocalidad)
        WHERE idCliente = ?", array("$id"));
    }

    public function actualizarCliente($id, $rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
      return $this->ConsultaPreparada
        ("UPDATE clientes INNER JOIN domicilio ON clientes.idDomicilio = domicilio.idDomicilio
          SET clientes.rfc = ? , clientes.nombre = ? , clientes.apellidoPaterno = ? , clientes.apellidoMaterno = ? ,
              clientes.telefono = ?, clientes.correo = ?,
              clientes.idEstado = ?, clientes.idMunicipio = ?, clientes.idLocalidad = ?,
              domicilio.colonia = ?, domicilio.calle = ?, domicilio.codigoPostal = ?, domicilio.numeroExt = ?, domicilio.numeroInt = ?
          WHERE clientes.idCliente = ?",
          array("$rfc","$nombre","$apellido","$apellido2","$telefono","$correo", $idEstado, $idMunicipio, $idLocalidad, "$colonia", "$calle", $codigoPostal, $numeroExt, $numeroInt, $id));
    }


}
