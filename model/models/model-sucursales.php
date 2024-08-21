<?php

class modeloSucursal  extends BD{
//esta consulta carga todas las sucursales de la base de datos
   public function consultarSucursales() {
        return $this->ConsultaPreparada("SELECT * FROM sucursal INNER JOIN domicilio on sucursal.idDomicilio = domicilio.idDomicilio", array(1));
    }
//esta consulta carga  sucursales con datos especificos de la base de datos
    function consultarSucursalesPorBusqueda($q){
    return $this->ConsultaPreparada("SELECT * FROM sucursal INNER JOIN domicilio on sucursal.idDomicilio = domicilio.idDomicilio WHERE
      sucursal LIKE ? OR
      telefono LIKE ? OR
      calle LIKE ? OR
      colonia LIKE ? OR
      numeroExt LIKE ? OR
      codigoPostal LIKE ? OR
      -- concat(apellidoPaterno,' ',apellidoMaterno,' ', nombre ) LIKE ? OR
      -- concat(nombre, ' ',apellidoPaterno,' ',apellidoMaterno) LIKE ? OR
      idSucursal LIKE ?
      ORDER BY idSucursal
      ",array("%$q%","%$q%","%$q%","%$q%","%$q%","%$q%","%$q%"));
  }

  public function agregarSucursal($nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
    $idDomicilio = (int) $this->ConsultaPreparada("SELECT MAX(idDomicilio) AS idDomicilio FROM domicilio", array(1))[0]['idDomicilio'] + 1;
      return $this->ConsultaPreparada
      ("INSERT INTO domicilio(idDomicilio, colonia, calle, codigoPostal, numeroExt, numeroInt)
        VALUES(?,?,?,?,?,?);
        INSERT INTO sucursal(sucursal, telefono, correo, idEstado, idMunicipio, idLocalidad, idEmpresa, idDomicilio)
          VALUES(?,?,?,?,?,?,?,?)",
      array($idDomicilio, "$colonia",  "$calle", $codigoPostal, $numeroExt, $numeroInt, "$nombre","$telefono","$correo", $idEstado, $idMunicipio, $idLocalidad, 1, $idDomicilio,));
    }

    public function eliminarSucursal($id){
        $idDomicilio= (int) $this->ConsultaPreparada("SELECT idDomicilio from sucursal where idSucursal = ?", array("$id"))[0]['idDomicilio'];
      return $this->consultaPreparada
      ("DELETE FROM sucursal   WHERE idSucursal = ?;
        DELETE FROM domicilio WHERE idDomicilio = ?;
       ",
        array("$id","$idDomicilio"));
    }
    public function consultarSucursal($id){
      return $this->ConsultaPreparada(
        "SELECT sucursal.sucursal, sucursal.telefono, sucursal.correo, sucursal.idEstado, sucursal.idMunicipio, sucursal.idLocalidad,
                domicilio.colonia, domicilio.calle, domicilio.codigoPostal, domicilio.numeroExt, domicilio.numeroInt,
                estados.estado, municipios.municipio, localidades.localidad
        FROM ((((sucursal INNER JOIN domicilio ON sucursal.idDomicilio = domicilio.idDomicilio)
                          INNER JOIN estados ON sucursal.idEstado = estados.idEstado)
                          INNER JOIN municipios ON sucursal.idMunicipio = municipios.idMunicipio)
                          INNER JOIN localidades ON sucursal.idLocalidad = localidades.idLocalidad)
        WHERE idSucursal = ?", array("$id"));
    }

    public function actualizarSucursal($id, $nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
      return $this->ConsultaPreparada
        ("UPDATE sucursal INNER JOIN domicilio ON sucursal.idDomicilio = domicilio.idDomicilio
          SET  sucursal.sucursal = ? , sucursal.telefono = ?, sucursal.correo = ?,
              sucursal.idEstado = ?, sucursal.idMunicipio = ?, sucursal.idLocalidad = ?,
              domicilio.colonia = ?, domicilio.calle = ?, domicilio.codigoPostal = ?, domicilio.numeroExt = ?, domicilio.numeroInt = ?
          WHERE sucursal.idSucursal = ?",
                                array("$nombre","$telefono","$correo", $idEstado, $idMunicipio, $idLocalidad, "$colonia", "$calle", $codigoPostal, $numeroExt, $numeroInt, $id));
    }
    // public function verConsulta($id){
    //   return (int) $this->ConsultaPreparada("SELECT idDomicilio from sucursal where idSucursal = ?", array("$id"))[0]['idDomicilio'];
    // }
}
