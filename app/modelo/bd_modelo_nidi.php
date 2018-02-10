<?php

function bd_tabla_modificar($tabla,$id,$campo,$valor){
    sql("UPDATE $tabla set $campo = '$valor' WHERE id = '$id'");
}
## nominas ##

function bd_nomina_salarios($cargo_id){
    $sql="
        SELECT  
            salario_diario DIARIO, 
            salario_semanal SEMANAL, 
            salario_quincenal QUINCENAL, 
            salario_mensual MENSUAL 
        FROM salarios 
        WHERE cargo_id = $cargo_id 
        ORDER BY f_inicio DESC 
        LIMIT 1; ";
    return sql2row($sql);
}



function bd_asignaciones($cedula, $periodo, $tipo){
    $tipos=[
        'A'=>'ASIGNACIÓN',
        'D'=>'DEDUCCIÓN',
    ];

    $sql="
        SELECT SUM(monto) 
        FROM ad_periodos 
        WHERE empleado_id = $cedula 
        AND periodo_id = $periodo 
        AND asigded_id IN (
            SELECT id 
            FROM asigdeds 
            WHERE tipo_ad = '{$tipos[$tipo]}' 
        ) 
        ORDER BY monto ASC ;";

    return sql2value($sql);
}

function bd_nominas_agregar($d){
    $sql = sprintf("
        INSERT INTO nominas (id, empleado_id, periodo_id, salario_periodo)
        VALUES ('%s','%s','%s','%s')",
        '',
        $d['empleado_id'],
        $d['periodo_id'],
        $d['salario']
    );

    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}





## salarios ##

function bd_salarios_agregar($d){

    $sql = sprintf("
        INSERT INTO salarios (
            id, f_inicio, cargo_id, salario_diario, salario_semanal, 
            salario_quincenal, salario_mensual
        )
        VALUES ('%s','%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['f_inicio'],
        $d['cargo_id'],
        $d['salario_diario'],
        $d['salario_semanal'],
        $d['salario_quincenal'],
        $d['salario_mensual']
        );
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_salarios_antsig($id)
{
    $sql  = "SELECT id FROM salarios WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM salarios WHERE id > '$id' ORDER BY id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

/**
*   Busca en la base de datos de acuerdo con el criterio dado
*/
function bd_salarios_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, f_inicio, cargo_id, salario_diario, salario_semanal, 
            salario_quincenal, salario_mensual
    FROM salarios WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_salarios_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM salarios WHERE $criterio");
}

function bd_salarios_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM salarios WHERE id = '$id'";
    return sql2row($sql);
}

function bd_salarios_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, f_inicio, cargo_id, salario_diario, salario_semanal, 
            salario_quincenal, salario_mensual
            FROM salarios ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, f_inicio, cargo_id, salario_diario, salario_semanal, 
            salario_quincenal, salario_mensual
            FROM salarios WHERE id = '$id' LIMIT 1");
    }
}

function bd_salarios_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM salarios ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_salarios_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM salarios WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_salarios_eliminar($id)
{
    $sql = sql("DELETE FROM salarios WHERE id = '$id'");
}

function bd_salarios_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM salarios WHERE id = '$id'";
    return sql2value($sql);
}

function bd_salarios_modificar($d){
   $sql=sprintf("
        UPDATE salarios SET
            id = '%s',
            f_inicio = '%s',
            cargo_id = '%s',
            salario_diario = '%s',
            salario_semanal = '%s',
            salario_quincenal = '%s',
            salario_mensual = '%s'
        WHERE id = '$d[id]' LIMIT 1",
            $d['id'],
            $d['f_inicio'],
            $d['cargo_id'],
            $d['salario_diario'],
            $d['salario_semanal'],
            $d['salario_quincenal'],
            $d['salario_mensual']
    );

   $res=sql($sql);
   return $d['id'];
}

function bd_salarios_opciones()
{
    $sql = "SELECT id,LEFT(id,60)
      FROM salarios
      ORDER BY id ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_salarios_opcionesb()
{
    $sql = "SELECT id,LEFT(id,60)
      FROM salarios
      ORDER BY id ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}
































## empleados ##

function bd_empleados_agregar($d){
    $sql = sprintf("
        INSERT INTO empleados (id, nombre, apellido, direccion, telefono, f_ingreso, condicion, f_vence, cargo_id, departamento_id, num_cuenta, num_hijo)
    VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['nombre'],
        $d['apellido'],
        $d['direccion'],
        $d['telefono'],
        $d['f_ingreso'],
        $d['condicion'],
        $d['f_vence'],
        $d['cargo_id'],
        $d['departamento_id'],
        $d['num_cuenta'],
        $d['num_hijo']
        );
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_empleados_antsig($id)
{
    $sql  = "SELECT id FROM empleados WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM empleados WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

/**
*   Busca en la base de datos de acuerdo con el criterio dado
*/
function bd_empleados_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, nombre, direccion, telefono
    FROM empleados WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_empleados_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM empleados WHERE $criterio");
}

function bd_empleados_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM empleados WHERE id = '$id'";
    return sql2row($sql);
}

function bd_empleados_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, nombre, apellido, direccion, telefono, f_ingreso, condicion, f_vence, cargo_id, departamento_id, num_cuenta, num_hijo
            FROM empleados ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, nombre, apellido, direccion, telefono, f_ingreso, condicion, f_vence, cargo_id, departamento_id, num_cuenta, num_hijo
            FROM empleados WHERE id = '$id' LIMIT 1");
    }
}

function bd_empleados_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM empleados ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_empleados_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM empleados WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_empleados_eliminar($id)
{
    $sql = sql("DELETE FROM empleados WHERE id = '$id'");
}

function bd_empleados_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM empleados WHERE id = '$id'";
    return sql2value($sql);
}


function bd_empleados_modificar($d){
   $sql=sprintf("UPDATE empleados SET
        nombre = '%s',
        apellido = '%s',
        direccion = '%s',
        telefono = '%s',
        f_ingreso = '%s',
        condicion = '%s',
        f_vence = '%s',
        cargo_id = '%s',
        departamento_id = '%s',
        num_cuenta = '%s',
        num_hijo = '%s'
        WHERE id = '$d[id]' LIMIT 1",
        $d['nombre'],
        $d['apellido'],
        $d['direccion'],
        $d['telefono'],
        $d['f_ingreso'],
        $d['condicion'],
        $d['f_vence'],
        $d['cargo_id'],
        $d['departamento_id'],
        $d['num_cuenta'],
        $d['num_hijo']);
   $res=sql($sql);
   return $d['id'];
}

function bd_empleados_opciones()
{
    $sql = "SELECT id,LEFT(nombre,60)
      FROM empleados
      ORDER BY nombre ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_empleados_opcionesb()
{
    $sql = "SELECT id,LEFT(nombre,60)
      FROM empleados
      ORDER BY nombre ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## det_efacturas ##
/*
function bd_det_efacturas_agregar($d)
{
    $sql = sprintf("INSERT INTO det_efacturas (id, efactura_id, existencia_id, cantidad, precio_u)
        VALUES ('%s','%s','%s','%s','%s')",
        $d['id'],
        $d['efactura_id'],
        $d['existencia_id'],
        $d['cantidad'],
        $d['precio_u']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_det_efacturas_antsig($id)
{
    $sql  = "SELECT id FROM det_efacturas WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM det_efacturas WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_det_efacturas_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, efactura_id, existencia_id, cantidad, precio_u
    FROM det_efacturas WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_det_efacturas_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM det_efacturas WHERE $criterio");
}

function bd_det_efacturas_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM det_efacturas WHERE id = '$id'";
    return sql2row($sql);
}

function bd_det_efacturas_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, efactura_id, existencia_id, cantidad, precio_u
            FROM det_efacturas ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, efactura_id, existencia_id, cantidad, precio_u
            FROM det_efacturas WHERE id = '$id' LIMIT 1");
    }
}

function bd_det_efacturas_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM det_efacturas ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_det_efacturas_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM det_efacturas WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_det_efacturas_eliminar($id)
{
    $sql = sql("DELETE FROM det_efacturas WHERE id = '$id'");
}

function bd_det_efacturas_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM det_efacturas WHERE id = '$id'";
    return sql2value($sql);
}

function bd_det_efacturas_modificar($d)
{
    $sql = sprintf("UPDATE det_efacturas SET efactura_id = '%s', existencia_id = '%s', cantidad = '%s', precio_u = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['efactura_id'], $d['existencia_id'], $d['cantidad'], $d['precio_u']);
    $res = sql($sql);
    return $d['id'];
}

function bd_det_efacturas_opciones()
{
    $sql = "SELECT id,LEFT(efactura_id,60)
FROM det_efacturas
ORDER BY efactura_id ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_det_efacturas_opcionesb()
{
    $sql = "SELECT id,LEFT(efactura_id,60)
      FROM det_efacturas
      ORDER BY efactura_id ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## det_facturas ##

function bd_det_facturas_agregar($d)
{
    $sql = sprintf("INSERT INTO det_facturas (id, factura_id, descripcion, unidad, cantidad, precio_u)
    VALUES ('%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['factura_id'],
        $d['descripcion'],
        $d['unidad'],
        $d['cantidad'],
        $d['precio_u']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_det_facturas_antsig($id)
{
    $sql  = "SELECT id FROM det_facturas WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM det_facturas WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_det_facturas_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 100)
{
    return sql2array("
    SELECT id, factura_id, descripcion, unidad, cantidad, precio_u
    FROM det_facturas WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_det_facturas_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM det_facturas WHERE $criterio");
}

function bd_det_facturas_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM det_facturas WHERE id = '$id'";
    return sql2row($sql);
}

function bd_det_facturas_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, factura_id, descripcion, unidad, cantidad, precio_u
            FROM det_facturas ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, factura_id, descripcion, unidad, cantidad, precio_u
            FROM det_facturas WHERE id = '$id' LIMIT 1");
    }
}

function bd_det_facturas_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM det_facturas ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_det_facturas_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM det_facturas WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_det_facturas_eliminar($id)
{
    $sql = sql("DELETE FROM det_facturas WHERE id = '$id'");
}

function bd_det_facturas_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM det_facturas WHERE id = '$id'";
    return sql2value($sql);
}

function bd_det_facturas_modificar($d)
{
    $sql = sprintf("UPDATE det_facturas
        SET factura_id = '%s', descripcion = '%s', unidad = '%s', cantidad = '%s', precio_u = '%s'
        WHERE id = '$d[id]'
        LIMIT 1",
        $d['factura_id'], $d['descripcion'], $d['unidad'], $d['cantidad'], $d['precio_u']);
    $res = sql($sql);
    return $d['id'];
}

function bd_det_facturas_opciones()
{
    $sql = "SELECT id,LEFT(factura_id,60)
      FROM det_facturas
      ORDER BY factura_id ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_det_facturas_opcionesb()
{
    $sql = "SELECT id,LEFT(factura_id,60)
      FROM det_facturas
      ORDER BY factura_id ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## det_presupuestos ##

function bd_det_presupuestos_agregar($d)
{

    $sql = sprintf("INSERT INTO det_presupuestos (id, presupuesto_id, unidad, cantidad, descripcion, precio_u)
    VALUES ('%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['presupuesto_id'],
        $d['unidad'],
        $d['cantidad'],
        $d['descripcion'],
        $d['precio_u']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_det_presupuestos_antsig($id)
{
    $sql  = "SELECT id FROM det_presupuestos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM det_presupuestos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_det_presupuestos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, presupuesto_id, unidad, cantidad, descripcion, precio_u
    FROM det_presupuestos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_det_presupuestos_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM det_presupuestos WHERE $criterio");
}

function bd_det_presupuestos_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM det_presupuestos WHERE id = '$id'";
    return sql2row($sql);
}

function bd_det_presupuestos_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, presupuesto_id, unidad, cantidad, descripcion, precio_u
            FROM det_presupuestos ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, presupuesto_id, unidad, cantidad, descripcion, precio_u
            FROM det_presupuestos WHERE id = '$id' LIMIT 1");
    }
}

function bd_det_presupuestos_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM det_presupuestos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_det_presupuestos_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM det_presupuestos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_det_presupuestos_eliminar($id)
{
    $sql = sql("DELETE FROM det_presupuestos WHERE id = '$id'");
}

function bd_det_presupuestos_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM det_presupuestos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_det_presupuestos_modificar($d)
{
    $sql = sprintf("UPDATE det_presupuestos SET presupuesto_id = '%s', unidad = '%s', cantidad = '%s', descripcion = '%s', precio_u = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['presupuesto_id'], $d['unidad'], $d['cantidad'], $d['descripcion'], $d['precio_u']);
    $res = sql($sql);
    return $d['id'];
}

function bd_det_presupuestos_opciones()
{
    $sql = "SELECT id,LEFT(presupuesto_id,60)
      FROM det_presupuestos
      ORDER BY presupuesto_id ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_det_presupuestos_opcionesb()
{
    $sql = "SELECT id,LEFT(presupuesto_id,60)
      FROM det_presupuestos
      ORDER BY presupuesto_id ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## efacturas ##

function bd_efacturas_agregar($d)
{
    $sql = sprintf("INSERT INTO efacturas (id, f_factura, proveedor_id)
    VALUES ('%s','%s','%s')",
        $d['id'],
        $d['f_factura'],
        $d['proveedor_id']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_efacturas_antsig($id)
{
    $sql  = "SELECT id FROM efacturas WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM efacturas WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_efacturas_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, f_factura, proveedor_id
    FROM efacturas WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_efacturas_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM efacturas WHERE $criterio");
}

function bd_efacturas_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM efacturas WHERE id = '$id'";
    return sql2row($sql);
}

function bd_efacturas_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, f_factura, proveedor_id
            FROM efacturas ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, f_factura, proveedor_id
            FROM efacturas WHERE id = '$id' LIMIT 1");
    }
}

function bd_efacturas_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM efacturas ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_efacturas_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM efacturas WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_efacturas_eliminar($id)
{
    $sql = sql("DELETE FROM efacturas WHERE id = '$id'");
}

function bd_efacturas_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM efacturas WHERE id = '$id'";
    return sql2value($sql);
}

function bd_efacturas_modificar($d)
{
    $sql = sprintf("UPDATE efacturas SET f_factura = '%s', proveedor_id = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['f_factura'], $d['proveedor_id']);
    $res = sql($sql);
    return $d['id'];
}

function bd_efacturas_opciones()
{
    $sql = "SELECT id,LEFT(f_factura,60)
      FROM efacturas
      ORDER BY f_factura ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_efacturas_opcionesb()
{
    $sql = "SELECT id,LEFT(f_factura,60)
      FROM efacturas
      ORDER BY f_factura ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## existencias ##

function bd_existencias_agregar($d)
{
    $sql = sprintf("INSERT INTO existencias (id, unidad, descripcion, existencia, precio_total)
    VALUES ('%s','%s','%s','%s','%s')",
        $d['id'],
        $d['unidad'],
        $d['descripcion'],
        $d['existencia'],
        $d['precio_total']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_existencias_antsig($id)
{
    $sql  = "SELECT id FROM existencias WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM existencias WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_existencias_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, unidad, descripcion, existencia, precio_total
    FROM existencias WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_existencias_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM existencias WHERE $criterio");
}

function bd_existencias_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM existencias WHERE id = '$id'";
    return sql2row($sql);
}

function bd_existencias_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, unidad, descripcion, existencia, precio_total
            FROM existencias ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, unidad, descripcion, existencia, precio_total
            FROM existencias WHERE id = '$id' LIMIT 1");
    }
}

function bd_existencias_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM existencias ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_existencias_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM existencias WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_existencias_eliminar($id)
{
    $sql = sql("DELETE FROM existencias WHERE id = '$id'");
}

function bd_existencias_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM existencias WHERE id = '$id'";
    return sql2value($sql);
}

function bd_existencias_modificar($d)
{
    $sql = sprintf("
        UPDATE existencias
        SET unidad = '%s', descripcion = '%s', existencia = '%s', precio_total = '%s'
        WHERE id = '$d[id]'
        LIMIT 1",
        $d['unidad'], $d['descripcion'], $d['existencia'], $d['precio_total']);
    $res = sql($sql);
    return $d['id'];
}

function bd_existencias_opciones()
{
    $sql = "SELECT id,LEFT(unidad,60)
      FROM existencias
      ORDER BY unidad ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_existencias_opcionesb()
{
    $sql = "SELECT id,LEFT(unidad,60)
      FROM existencias
      ORDER BY unidad ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## facturas ##

function bd_facturas_agregar($d)
{
    $sql = sprintf("INSERT INTO facturas (id, f_factura, cliente_id, guiadordene, f_oe, cond_pago, porc_bi, porc_iva, desc_ajuste, monto_ajuste)
    VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['f_factura'],
        $d['cliente_id'],
        $d['guiadordene'],
        $d['f_oe'],
        $d['cond_pago'],
        $d['porc_bi'],
        $d['porc_iva'],
        $d['desc_ajuste'],
        $d['monto_ajuste']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_facturas_antsig($id)
{
    $sql  = "SELECT id FROM facturas WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM facturas WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_facturas_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, f_factura, cliente_id, guiadordene,
        f_oe, cond_pago, porc_bi, porc_iva,
        desc_ajuste, monto_ajuste
    FROM facturas WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_facturas_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM facturas WHERE $criterio");
}

function bd_facturas_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM facturas WHERE id = '$id'";
    return sql2row($sql);
}

function bd_facturas_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        $d = sql2array("SELECT id, f_factura, cliente_id, guiadordene, f_oe, cond_pago, porc_bi, porc_iva, desc_ajuste, monto_ajuste
            FROM facturas ORDER BY {$orden}");
    } else {
        $d = sql2array("SELECT id, f_factura, cliente_id, guiadordene, f_oe, cond_pago, porc_bi, porc_iva, desc_ajuste, monto_ajuste
            FROM facturas WHERE id = '$id' LIMIT 1");
    }
    return $d;
}

function bd_factura_datos($id)
{
    $d = sql2row("
        SELECT id, f_factura, cliente_id, guiadordene, f_oe, cond_pago, porc_bi, porc_iva, desc_ajuste, monto_ajuste
        FROM facturas
        WHERE id = '$id'
        LIMIT 1
    ");
    $d['cliente'] = bd_empleados_datos($d['cliente_id']);
    $d['fd']      = sql2array(
        "SELECT id, factura_id, descripcion, unidad, cantidad, precio_u
        FROM det_facturas
        WHERE factura_id LIKE {$d['id']}"
    );
    return $d;
}

function bd_facturas_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM facturas
        WHERE  anulada='NO'
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_facturas_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM facturas WHERE $condicion AND anulada='NO'
            LIMIT $cantidad
        ");
}

function bd_facturas_eliminar($id)
{
    $sql = sql("UPDATE facturas SET anulada = 'SI' WHERE id = '$id'");
    $sql = sql("UPDATE det_facturas SET anulada = 'SI' WHERE factura_id = '$id'");
}

function bd_facturas_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM facturas WHERE id = '$id'";
    return sql2value($sql);
}

function bd_facturas_modificar($d)
{
    $sql = sprintf("UPDATE facturas SET f_factura = '%s', cliente_id = '%s', guiadordene = '%s', f_oe = '%s', cond_pago = '%s', porc_bi = '%s', porc_iva = '%s', desc_ajuste = '%s', monto_ajuste = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['f_factura'], $d['cliente_id'], $d['guiadordene'], $d['f_oe'], $d['cond_pago'], $d['porc_bi'], $d['porc_iva'], $d['desc_ajuste'], $d['monto_ajuste']);
    $res = sql($sql);
    return $d['id'];
}

function bd_facturas_opciones()
{
    $sql = "SELECT id,LEFT(f_factura,60)
      FROM facturas
      ORDER BY f_factura ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_facturas_opcionesb()
{
    $sql = "SELECT id,LEFT(f_factura,60)
      FROM facturas
      ORDER BY f_factura ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}
*/
## cargos ##

function bd_cargos_agregar($d)
{
    $sql = sprintf("INSERT INTO cargos (id, cargo)
    VALUES ('%s','%s')",
        $d['id'],
        $d['cargo']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_cargos_antsig($id)
{
    $sql  = "SELECT id FROM cargos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM cargos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_cargos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, cargo
    FROM cargos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_cargos_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM cargos WHERE $criterio");
}

function bd_cargos_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM cargos WHERE id = '$id'";
    return sql2row($sql);
}

function bd_cargos_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, cargo
            FROM cargos ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, cargo
            FROM cargos WHERE id = '$id' LIMIT 1");
    }
}

function bd_cargos_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM cargos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_cargos_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM cargos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_cargos_eliminar($id)
{
    $sql = sql("DELETE FROM cargos WHERE id = '$id'");
}

function bd_cargos_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM cargos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_cargos_modificar($d)
{
    $sql = sprintf("UPDATE cargos SET proveedor_id = '%s', f_orden = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['proveedor_id'], $d['f_orden']);
    $res = sql($sql);
    return $d['id'];
}

function bd_cargos_opciones()
{
    $sql = "SELECT id,LEFT(cargo,60)
      FROM cargos
      ORDER BY cargo ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_cargos_opcionesb()
{
    $sql = "SELECT id,LEFT(proveedor_id,60)
      FROM cargos
      ORDER BY proveedor_id ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}
/*
## presupuestos ##

function bd_presupuestos_agregar($d)
{
    $sql = sprintf("INSERT INTO presupuestos (id, f_ppto, cliente_id, porc_iva)
    VALUES ('%s','%s','%s','%s')",
        $d['id'],
        $d['f_ppto'],
        $d['cliente_id'],
        $d['porc_iva']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_presupuestos_antsig($id)
{
    $sql  = "SELECT id FROM presupuestos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM presupuestos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_presupuestos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, f_ppto, cliente_id, porc_iva, cond_pago
    FROM presupuestos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_presupuestos_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM presupuestos WHERE $criterio");
}

function bd_presupuestos_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM presupuestos WHERE id = '$id'";
    return sql2row($sql);
}

function bd_presupuestos_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT *
            FROM presupuestos ORDER BY {$orden}");
    } else {
        return sql2row("SELECT *
            FROM presupuestos WHERE id LIKE '$id' LIMIT 1");
    }
}

function bd_presupuestos_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM presupuestos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_presupuestos_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM presupuestos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_presupuestos_eliminar($id)
{
    $sql = sql("DELETE FROM presupuestos WHERE id = '$id'");
}

function bd_presupuestos_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM presupuestos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_presupuestos_modificar($d)
{
    $sql = sprintf("UPDATE presupuestos SET f_ppto = '%s', cliente_id = '%s', porc_iva = '%s', cond_pago = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['f_ppto'], $d['cliente_id'], $d['porc_iva'], $d['cond_pago']);
    $res = sql($sql);
    return $d['id'];
}

function bd_presupuestos_opciones()
{
    $sql = "SELECT id,LEFT(f_ppto,60)
      FROM presupuestos
      ORDER BY f_ppto ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_presupuestos_opcionesb()
{
    $sql = "SELECT id,LEFT(f_ppto,60)
      FROM presupuestos
      ORDER BY f_ppto ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## proveedores ##

function bd_proveedores_agregar($d)
{
    $sql = sprintf("INSERT INTO proveedores (id, nombre, direccion, telefono)
    VALUES ('%s','%s','%s','%s')",
        $d['id'],
        $d['nombre'],
        $d['direccion'],
        $d['telefono']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_proveedores_antsig($id)
{
    $sql  = "SELECT id FROM proveedores WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM proveedores WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_proveedores_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, nombre, direccion, telefono
    FROM proveedores WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_proveedores_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM proveedores WHERE $criterio");
}

function bd_proveedores_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM proveedores WHERE id = '$id'";
    return sql2row($sql);
}

function bd_proveedores_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, nombre, direccion, telefono
            FROM proveedores ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, nombre, direccion, telefono
            FROM proveedores WHERE id = '$id' LIMIT 1");
    }
}

function bd_proveedores_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM proveedores ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_proveedores_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM proveedores WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_proveedores_eliminar($id)
{
    $sql = sql("DELETE FROM proveedores WHERE id = '$id'");
}

function bd_proveedores_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM proveedores WHERE id = '$id'";
    return sql2value($sql);
}

function bd_proveedores_modificar($d)
{
    $sql = sprintf("UPDATE proveedores SET nombre = '%s', direccion = '%s', telefono = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['nombre'], $d['direccion'], $d['telefono']);
    $res = sql($sql);
    return $d['id'];
}

function bd_proveedores_opciones()
{
    $sql = "SELECT id,LEFT(nombre,60)
      FROM proveedores
      ORDER BY nombre ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_proveedores_opcionesb()
{
    $sql = "SELECT id,LEFT(nombre,60)
      FROM proveedores
      ORDER BY nombre ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}
*/
## usuarios ##
function bd_usuarios_verificar($d)
{
    $id    = $d['id'];
    $clave = $d['clave'];
    $hash  = sql2value("SELECT clave FROM usuarios WHERE id LIKE '{$d['id']}' LIMIT 1");
    if (password_verify($clave, $hash)) {
        return bd_usuarios_buscar("id='$id'");
    } else {
        return null;
    }
}

function bd_usuarios_cambiar_clave($d)
{
    $d['hash'] = cifra_clave($d['clave']);

    return sql("UPDATE usuarios
                SET clave = '{$d['hash']}' WHERE id = '{$d['id']}';
");
}

function bd_usuarios_agregar($d)
{
    $sql = sprintf("INSERT INTO usuarios (id, clave, nombre, nivel, email, activo)
    VALUES ('%s','%s','%s','%s','%s','%s')",
        $d['id'],
        $d['clave'],
        $d['nombre'],
        $d['nivel'],
        $d['email'],
        $d['activo']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_usuarios_antsig($id)
{
    $sql  = "SELECT id FROM usuarios WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM usuarios WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_usuarios_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1)
{
    return sql2array("
    SELECT id, clave, nombre, nivel, email, activo
    FROM usuarios WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_usuarios_contar($criterio = '1')
{
    return sql2value("SELECT COUNT(*) FROM usuarios WHERE $criterio");
}

function bd_usuarios_dato($id, $campo)
{
    $sql = "SELECT id, $campo  FROM usuarios WHERE id = '$id'";
    return sql2row($sql);
}

function bd_usuarios_datos($id = null, $orden = 'id ASC')
{
    if ($id == null) {
        return sql2array("SELECT id, clave, nombre, nivel, email, activo
            FROM usuarios ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, clave, nombre, nivel, email, activo
            FROM usuarios WHERE id = '$id' LIMIT 1");
    }
}

function bd_usuarios_datos2($inicio, $cantidad, $orden = 'id')
{
    return sql2array("SELECT * FROM usuarios ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_usuarios_datos21($campos, $palabras, $cantidad)
{
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM usuarios WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_usuarios_eliminar($id)
{
    $sql = sql("DELETE FROM usuarios WHERE id = '$id'");
}

function bd_usuarios_existe($id)
{
    $sql = "SELECT COUNT(*) as n FROM usuarios WHERE id = '$id'";
    return sql2value($sql);
}

function bd_usuarios_modificar($d)
{
    $sql = sprintf("UPDATE usuarios SET  nombre = '%s', nivel = '%s', email = '%s', activo = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['nombre'], $d['nivel'], $d['email'], $d['activo']);
    $res = sql($sql);
    return $d['id'];
}

function bd_usuarios_opciones()
{
    $sql = "SELECT id,LEFT(clave,60)
      FROM usuarios
      ORDER BY clave ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_usuarios_opcionesb()
{
    $sql = "SELECT id,LEFT(clave,60)
      FROM usuarios
      ORDER BY clave ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

## departamentos ##

function bd_departamentos_agregar($d){
    $sql = sprintf("INSERT INTO departamentos (id, departamento)
    VALUES ('%s','%s')",
        $d['id'],
        $d['departamento']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_departamentos_antsig($id){
    $sql  = "SELECT id FROM departamentos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM departamentos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_departamentos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1){
    return sql2array("
    SELECT id, departamento
    FROM departamentos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_departamentos_contar($criterio = '1'){
    return sql2value("SELECT COUNT(*) FROM departamentos WHERE $criterio");
}

function bd_departamentos_dato($id, $campo){
    $sql = "SELECT id, $campo  FROM departamentos WHERE id = '$id'";
    return sql2row($sql);
}

function bd_departamentos_datos($id = null, $orden = 'id ASC'){
    if ($id == null) {
        return sql2array("SELECT id, departamento
            FROM departamentos ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, departamento
            FROM departamentos WHERE id = '$id' LIMIT 1");
    }
}

function bd_departamentos_datos2($inicio, $cantidad, $orden = 'id'){
    return sql2array("SELECT * FROM departamentos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_departamentos_datos21($campos, $palabras, $cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM departamentos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_departamentos_eliminar($id){
    $sql = sql("DELETE FROM departamentos WHERE id = '$id'");
}

function bd_departamentos_existe($id){
    $sql = "SELECT COUNT(*) as n FROM departamentos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_departamentos_modificar($d){
    $sql = sprintf("UPDATE departamentos SET departamento = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['departamento']);
    $res = sql($sql);
    return $d['id'];
}

function bd_departamentos_opciones(){
    $sql = "SELECT id,LEFT(departamento,60)
      FROM departamentos
      ORDER BY departamento ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_departamentos_opcionesb()
{
    $sql = "SELECT id,LEFT(departamento,60)
      FROM departamentos
      ORDER BY departamento ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}



## asigdeds ##


function bd_asigdeds_agregar($d){
    $sql = sprintf("INSERT INTO asigdeds (id, nombre, tipo_ad, tipo, valor)
    VALUES ('%s','%s','%s','%s','%s')",
        $d['id'],
        $d['nombre'],
        $d['tipo_ad'],
        $d['tipo'],
        $d['valor']);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_asigdeds_antsig($id){
    $sql  = "SELECT id FROM asigdeds WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM asigdeds WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_asigdeds_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1){
    return sql2array("
    SELECT id, nombre, tipo_ad, tipo, valor
    FROM asigdeds WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_asigdeds_contar($criterio = '1'){
    return sql2value("SELECT COUNT(*) FROM asigdeds WHERE $criterio");
}

function bd_asigdeds_dato($id, $campo){
    $sql = "SELECT id, $campo  FROM asigdeds WHERE id = '$id'";
    return sql2row($sql);
}

function bd_asigdeds_datos($id = null, $orden = 'id ASC'){
    if ($id == null) {
        return sql2array("SELECT id, nombre, tipo_ad, tipo, valor
            FROM asigdeds ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, nombre, tipo_ad, tipo, valor
            FROM asigdeds WHERE id = '$id' LIMIT 1");
    }
}

function bd_asigdeds_datos2($inicio, $cantidad, $orden = 'id'){
    return sql2array("SELECT * FROM asigdeds ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_asigdeds_datos21($campos, $palabras, $cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM asigdeds WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_asigdeds_eliminar($id){
    $sql = sql("DELETE FROM asigdeds WHERE id = '$id'");
}

function bd_asigdeds_existe($id){
    $sql = "SELECT COUNT(*) as n FROM asigdeds WHERE id = '$id'";
    return sql2value($sql);
}
 
function bd_asigdeds_modificar($d){
    $sql = sprintf("UPDATE asigdeds SET nombre = '%s'tipo_ad = '%s'tipo = '%s' valor = '%s' WHERE id = '$d[id]' LIMIT 1",
        $d['nombre'], $d['tipo_ad'], $d['tipo'], $d['valor']);
    $res = sql($sql);
    return $d['id'];
}

function bd_asigdeds_opciones(){
    $sql = "SELECT id,LEFT(asigded,60)
      FROM asigdeds
      ORDER BY asigded ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_asigdeds_opcionesb()
{
    $sql = "SELECT id,LEFT(asigded,60)
      FROM asigdeds
      ORDER BY asigded ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}






## ad_periodos ##

function bd_ad_periodos_agregar($d){
    $sql = sprintf("
            INSERT INTO ad_periodos (id, empleado_id, periodo_id, asigded_id, monto)
            VALUES ('','%s','%s','%s','%s')
        ",
        $d['empleado_id'],
        $d['periodo_id'],
        $d['asigded_id'],
        $d['monto']
    );

    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;
}

function bd_ad_periodos_antsig($id){
    $sql  = "SELECT id FROM ad_periodos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT id FROM ad_periodos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_ad_periodos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1){
    return sql2array("
    SELECT id, ad_periodo
    FROM ad_periodos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_ad_periodos_contar($criterio = '1'){
    return sql2value("SELECT COUNT(*) FROM ad_periodos WHERE $criterio");
}

function bd_ad_periodos_dato($id, $campo){
    $sql = "SELECT id, $campo  FROM ad_periodos WHERE id = '$id'";
    return sql2row($sql);
}
 
function bd_ad_periodos_datos($id = null, $orden = 'id ASC'){
    if ($id == null) {
        return sql2array("SELECT id, empleado_id, periodo_id, asigded_id, monto
            FROM ad_periodos ORDER BY {$orden}");
    } else {
        return sql2row("SELECT id, empleado_id, periodo_id, asigded_id, monto
            FROM ad_periodos WHERE id = '$id' LIMIT 1");
    }
}

function bd_ad_periodos_datos2($inicio, $cantidad, $orden = 'id'){
    return sql2array("SELECT * FROM ad_periodos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

/**
 * Devuelve las asignaciones y deducciones para el recibo de nómina
 * 
 * @param  Integer $id    Cédula del trabajador
 * @param  Integer $p_id  Código del periodo de nómina
 * @return Array          Asignaciones y deducciones
 */
function bd_ad_periodos_nomina($id, $p_id){
    $sql = "
        SELECT empleado_id, periodo_id, asigded_id, monto 
        FROM ad_periodos 
        WHERE empleado_id = {$id} 
            AND periodo_id = {$p_id} 
    ";

    $temp = sql2array($sql);
    $ad_a = $ad_b = [];
    $tot_a = $tot_d = 0;
    foreach ($temp as &$ad) {
        $ad['montoz'] = cts2bsf($ad['monto']);

        $ad['d'] = bd_asigdeds_datos($ad['asigded_id']);
        if ($ad['d']['tipo_ad'] == 'ASIGNACIÓN') {
            $ad_a[]=$ad;
            $tot_a += $ad['monto'];
        }else{
            $ad_d[]=$ad;
            $tot_d += $ad['monto'];
        }
    }
    
    $temp0['a']=$ad_a;
    $temp0['d']=$ad_d;
    $temp0['tot_a'] = cts2bsf($tot_a);
    $temp0['tot_d'] = cts2bsf($tot_d);
    $temp0['apagar'] = cts2bsf($tot_a - $tot_d);

    return $temp0;
}


function bd_ad_periodos_datos21($campos, $palabras, $cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM ad_periodos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_ad_periodos_eliminar($id){
    $sql = sql("DELETE FROM ad_periodos WHERE id = '$id'");
}

function bd_ad_periodos_existe($id){
    $sql = "SELECT COUNT(*) as n FROM ad_periodos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_ad_periodos_modificar($d){
    $sql = sprintf("UPDATE ad_periodos SET empleado_id = '%s' periodo_id = '%s' asigded_id = '%s' monto = '%s'
     WHERE id = '$d[id]' LIMIT 1",
      $d['empleado_id'], $d['periodo_id'], $d['asigded_id'], $d['monto']);
    $res = sql($sql); 
    return $d['id'];
}

function bd_ad_periodos_opciones(){
    $sql = "SELECT id,LEFT(ad_periodo,60)
      FROM ad_periodos
      ORDER BY ad_periodo ASC";
    $res = sql2options($sql);
    return $res;
}

function bd_ad_periodos_opcionesb()
{
    $sql = "SELECT id,LEFT(ad_periodo,60)
      FROM ad_periodos
      ORDER BY ad_periodo ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}

##periodos ##

function bd_periodos_agregar($d){
   /* $sql = sprintf("INSERT INTO periodos (id, f_inicio, f_final, tipo_periodo, n_dias_lab, condicion)
    VALUES ('%s','%s','%s','%s', 'ABIERTO')",
        $d['id'],
        $d['f_inicio'],
        $d['f_final'],
        $d['tipo_periodo'],
        0);
    $res = sql($sql);
    $id  = sql2value("SELECT LAST_INSERT_ID()");
    return $id;*/
}

function bd_periodos_agregar_varios($d){
    foreach ($d['p'] as $p) {
        $sql = sprintf("
            INSERT INTO periodos (
                id, 
                f_inicio, 
                f_final, 
                n_lunes,
                tipo_periodo, 
                n_dias_lab, 
                condicion
            )VALUES (
                '', 
                '%s', 
                '%s',
                '%s', 
                '%s', 
                '%s', 
                'ABIERTO'
            )",
            $p[0],
            $p[1],
            numlunes($p[0], $p[1]),
            $d['tipo_periodo'],
            1
        );
        $res = sql($sql);
        $id  = sql2value("SELECT LAST_INSERT_ID()");
    }
}

function bd_periodos_antsig($id){
    $sql  = "
        SELECT id FROM periodos 
        WHERE id < '$id'
        AND  
        ORDER BY id DESC LIMIT 1
    ";
    $sql2 = "
        SELECT id FROM periodos 
        WHERE id > '$id' 
        ORDER BY `id` ASC LIMIT 1
    ";
    $res1 = sql2value($sql);
    $res2 = sql2value($sql2);
    return array('a' => $res1, 's' => $res2);
}

function bd_periodos_buscar($criterio, $orden = 'id ASC', $inicio = 0, $cantidad = 1){
    return sql2array("
    SELECT id, periodo
    FROM periodos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_periodos_contar($criterio = '1'){
    return sql2value("SELECT COUNT(*) FROM periodos WHERE $criterio");
}

function bd_periodos_dato($id, $campo){
    $sql = "SELECT id, $campo  FROM periodos WHERE id = '$id'";
    return sql2row($sql);
}
 
function bd_periodos_datos($id = null, $orden = 'id ASC'){
    if ($id == null) {
        return sql2array("
            SELECT id, f_inicio, f_final, tipo_periodo, 
            n_lunes, n_dias_lab, condicion, calculado
            FROM periodos ORDER BY {$orden}
        ");
    } else {  
        return sql2row("
            SELECT id, f_inicio, f_final, tipo_periodo, 
            n_lunes, n_dias_lab, condicion,calculado
            FROM periodos WHERE id = '$id' LIMIT 1
        ");
    }
}

function bd_periodos_datos2($inicio, $cantidad, $orden = 'id'){
    return sql2array("SELECT * FROM periodos ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
        ");
}

function bd_periodos_datos21($campos, $palabras, $cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("SELECT * FROM periodos WHERE $condicion
            LIMIT $cantidad
        ");
}

function bd_periodos_eliminar($id){
    $sql = sql("DELETE FROM periodos WHERE id = '$id'");
}

function bd_periodos_existe($id){
    $sql = "SELECT COUNT(*) as n FROM periodos WHERE id = '$id'";
    return sql2value($sql);
}

function bd_periodos_modificar($d){
    $sql = sprintf("UPDATE periodos SET n_dias_lab = '%s', condicion = '%s'       
     WHERE id = '$d[id]' LIMIT 1",
      $d['n_dias_lab'], $d['condicion']);
    $res = sql($sql); 
    return $d['id'];
}

function bd_periodos_opciones(){
    $sql = "SELECT id,LEFT(CONCAT(f_inicio, ' :: ', f_final, ' [', n_dias_lab, ' días laborables]'),60)
      FROM periodos
      WHERE condicion LIKE 'ABIERTO'
      ORDER BY f_inicio DESC";
    $res = sql2options($sql);
    return $res;
}

function bd_periodos_opcionesb()
{
    $sql = "SELECT id,LEFT(periodo,60)
      FROM periodos
      ORDER BY periodo ASC";
    $res      = sql2options($sql);
    $zz       = array();
    $zz['--'] = '';
    foreach ($res as $id => $valor) {
        $zz[$id] = $valor;
    }
    return $zz;
}



function bd_variables(){
    $sql="SELECT id,valor FROM variables ORDER BY id ASC;";
    return sql2options($sql);
}

