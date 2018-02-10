<?php

/**
 * Devuelve los productos que vende un proveedor
 * @param  int $proveedor_id Id del proveedor
 * @return array               Array de los productos
 */
function bd_productosxproveedor($proveedor_id){
	$sql="
		SELECT a.nombre
		FROM productos a, productos_proveedores b
		WHERE b.proveedor_id = {$proveedor_id}
		AND b.producto_id=a.id
		";
	return sql2array($sql);
}

function bd_meta_tabla($tabla){
    return sql2array("SELECT id, etiqueta, ayuda, error
        FROM metadatos
        WHERE id LIKE '{$tabla}.%'; ");
}


## clientes ##

function bd_clientes_agregar($d){
   $sql = sprintf("INSERT INTO clientes (id, nombre, telefono, direccion, intermediario_id)
    VALUES ('%s','%s','%s','%s','%s')",
    $d['id'],
    $d['nombre'],
    $d['telefono'],
    $d['direccion'],
    $d['intermediario_id']);
   $res = sql($sql);
   $id  = sql2value("SELECT LAST_INSERT_ID()");
   return $id;
}

function bd_clientes_antsig($id){
   $sql  = "SELECT id FROM clientes WHERE id < '$id' ORDER BY id DESC LIMIT 1";
   $sql2 = "SELECT id FROM clientes WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
   $res1 = sql2value($sql);
   $res2 = sql2value($sql2);
   return array('a'=>$res1,'s'=>$res2);
}

function bd_clientes_buscar($criterio,$orden='id ASC',$inicio=0,$cantidad=1){
   return sql2array("
    SELECT id, nombre, telefono, direccion, intermediario_id
    FROM clientes WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_clientes_contar($criterio='1'){
    return sql2value("
        SELECT COUNT(*)
        FROM clientes
        WHERE $criterio
    ");
}

function bd_clientes_dato($id,$campo){
    $sql="SELECT id, $campo  FROM clientes WHERE id = '$id'";
    return sql2row($sql);
}

function bd_clientes_datos($id=NULL, $orden='id ASC'){
    if ($id==NULL)    {
        return sql2array("
            SELECT id, nombre, telefono, direccion, intermediario_id
            FROM clientes
            ORDER BY {$orden}");
    }else{
        return sql2row("
            SELECT id, nombre, telefono, direccion, intermediario_id
            FROM clientes
            WHERE id = '$id'
            LIMIT 1");
    }
}

function bd_clientes_datos2($inicio, $cantidad, $orden='id'){
    return sql2array("
        SELECT * FROM clientes
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
    ");
}

function bd_clientes_datos21($campos, $palabras,$cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("
        SELECT * FROM clientes
        WHERE $condicion
        LIMIT $cantidad
        ");
}

function bd_clientes_eliminar($id){
   $sql=sql("DELETE FROM clientes WHERE id = '$id'");
}

function bd_clientes_existe($id){
   $sql="SELECT COUNT(*) as n FROM clientes WHERE id = '$id'";
   return sql2value($sql);
}

function bd_clientes_modificar($d){
   $sql=sprintf("UPDATE clientes SET nombre = '%s', telefono = '%s', direccion = '%s', intermediario_id = '%s' WHERE id = '$d[id]' LIMIT 1",
$d['nombre'], $d['telefono'], $d['direccion'], $d['intermediario_id']);
   $res=sql($sql);
   return $d['id'];
}

function bd_clientes_opciones(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM clientes
      ORDER BY nombre ASC";
   $res=sql2options($sql);
   return $res;
}

function bd_clientes_opcionesb(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM clientes
      ORDER BY nombre ASC";
   $res=sql2options($sql);
    $zz=array();
    $zz['--']='';
    foreach($res as $id=>$valor){
       $zz[$id]=$valor;
   }
   return $zz;
}

## intermediarios ##

function bd_intermediarios_agregar($d){
   $sql = sprintf("INSERT INTO intermediarios (id, nombre)
    VALUES ('%s','%s')",
    $d['id'],
    $d['nombre']);
   $res = sql($sql);
   $id  = sql2value("SELECT LAST_INSERT_ID()");
   return $id;
}

function bd_intermediarios_antsig($id){
   $sql  = "SELECT id FROM intermediarios WHERE id < '$id' ORDER BY id DESC LIMIT 1";
   $sql2 = "SELECT id FROM intermediarios WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
   $res1 = sql2value($sql);
   $res2 = sql2value($sql2);
   return array('a'=>$res1,'s'=>$res2);
}

function bd_intermediarios_buscar($criterio,$orden='id ASC',$inicio=0,$cantidad=1){
   return sql2array("
    SELECT id, nombre
    FROM intermediarios WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_intermediarios_contar($criterio='1'){
    return sql2value("
        SELECT COUNT(*)
        FROM intermediarios
        WHERE $criterio
    ");
}

function bd_intermediarios_dato($id,$campo){
    $sql="SELECT id, $campo  FROM intermediarios WHERE id = '$id'";
    return sql2row($sql);
}

function bd_intermediarios_datos($id=NULL, $orden='id ASC'){
    if ($id==NULL)    {
        return sql2array("
            SELECT id, nombre
            FROM intermediarios
            ORDER BY {$orden}");
    }else{
        return sql2row("
            SELECT id, nombre
            FROM intermediarios
            WHERE id = '$id'
            LIMIT 1");
    }
}

function bd_intermediarios_datos2($inicio, $cantidad, $orden='id'){
    return sql2array("
        SELECT * FROM intermediarios
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
    ");
}

function bd_intermediarios_datos21($campos, $palabras,$cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("
        SELECT * FROM intermediarios
        WHERE $condicion
        LIMIT $cantidad
        ");
}

function bd_intermediarios_eliminar($id){
   $sql=sql("DELETE FROM intermediarios WHERE id = '$id'");
}

function bd_intermediarios_existe($id){
   $sql="SELECT COUNT(*) as n FROM intermediarios WHERE id = '$id'";
   return sql2value($sql);
}

function bd_intermediarios_modificar($d){
   $sql=sprintf("UPDATE intermediarios SET nombre = '%s' WHERE id = '$d[id]' LIMIT 1",
$d['nombre']);
   $res=sql($sql);
   return $d['id'];
}

function bd_intermediarios_opciones(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM intermediarios
      ORDER BY nombre ASC";
   $res=sql2options($sql);
   return $res;
}

function bd_intermediarios_opcionesb(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM intermediarios
      ORDER BY nombre ASC";
   $res=sql2options($sql);
    $zz=array();
    $zz['--']='';
    foreach($res as $id=>$valor){
       $zz[$id]=$valor;
   }
   return $zz;
}

## productos ##

function bd_productos_agregar($d){
   $sql = sprintf("INSERT INTO productos (id, nombre, unidadcompra)
    VALUES ('%s','%s','%s')",
    $d['id'],
    $d['nombre'],
    $d['unidadcompra']);
   $res = sql($sql);
   $id  = sql2value("SELECT LAST_INSERT_ID()");
   return $id;
}

function bd_productos_antsig($id){
   $sql  = "SELECT id FROM productos WHERE id < '$id' ORDER BY id DESC LIMIT 1";
   $sql2 = "SELECT id FROM productos WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
   $res1 = sql2value($sql);
   $res2 = sql2value($sql2);
   return array('a'=>$res1,'s'=>$res2);
}

function bd_productos_buscar($criterio,$orden='id ASC',$inicio=0,$cantidad=1){
   return sql2array("
    SELECT id, nombre, unidadcompra
    FROM productos WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_productos_contar($criterio='1'){
    return sql2value("
        SELECT COUNT(*)
        FROM productos
        WHERE $criterio
    ");
}

function bd_productos_dato($id,$campo){
    $sql="SELECT id, $campo  FROM productos WHERE id = '$id'";
    return sql2row($sql);
}

function bd_productos_datos($id=NULL, $orden='id ASC'){
    if ($id==NULL)    {
        return sql2array("
            SELECT id, nombre, unidadcompra
            FROM productos
            ORDER BY {$orden}");
    }else{
        return sql2row("
            SELECT id, nombre, unidadcompra
            FROM productos
            WHERE id = '$id'
            LIMIT 1");
    }
}

function bd_productos_datos2($inicio, $cantidad, $orden='id'){
    return sql2array("
        SELECT * FROM productos
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
    ");
}

function bd_productos_datos21($campos, $palabras,$cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("
        SELECT * FROM productos
        WHERE $condicion
        LIMIT $cantidad
        ");
}

function bd_productos_eliminar($id){
   $sql=sql("DELETE FROM productos WHERE id = '$id'");
}

function bd_productos_existe($id){
   $sql="SELECT COUNT(*) as n FROM productos WHERE id = '$id'";
   return sql2value($sql);
}

function bd_productos_modificar($d){
   $sql=sprintf("UPDATE productos SET nombre = '%s', unidadcompra = '%s' WHERE id = '$d[id]' LIMIT 1",
$d['nombre'], $d['unidadcompra']);
   $res=sql($sql);
   return $d['id'];
}

/**
 * Devuelve un array con los productos que se pueden seleccionar
 * @param  integer $n_car Número de caracteres máximo a mostrar (por defecto son 60)
 * @return Array         Array con id y descripción del producto.
 */
function bd_productos_opciones($n_car=60){
   $sql="SELECT id, LEFT(nombre,$n_car)
      FROM productos
      ORDER BY nombre ASC";
   $res=sql2options($sql);
   return $res;
}

function bd_productos_opcionesb(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM productos
      ORDER BY nombre ASC";
   $res=sql2options($sql);
    $zz=array();
    $zz['--']='';
    foreach($res as $id=>$valor){
       $zz[$id]=$valor;
   }
   return $zz;
}

## proveedores ##

function bd_proveedores_agregar($d){
	$sql = sprintf("INSERT INTO proveedores (id, nombre, apodo, ubicacion, intermediario_id)
		VALUES (NULL,'%s','%s','%s','%s')",
		$d['nombre'],
		$d['apodo'],
		$d['ubicacion'],
		$d['intermediario_id']
	);

	$res = sql($sql);
	$id  = sql2value("SELECT LAST_INSERT_ID()");

	foreach ($d['productos'] as $producto_id) {
		$sql=sprintf("INSERT INTO productos_proveedores (id, producto_id, proveedor_id)
			VALUES(NULL, '%s','%s')",
			$producto_id, $id);
		$res=sql($sql);
	}
	return $id;
}

function bd_proveedores_antsig($id){
   $sql  = "SELECT id FROM proveedores WHERE id < '$id' ORDER BY id DESC LIMIT 1";
   $sql2 = "SELECT id FROM proveedores WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
   $res1 = sql2value($sql);
   $res2 = sql2value($sql2);
   return array('a'=>$res1,'s'=>$res2);
}

function bd_proveedores_buscar($criterio,$orden='id ASC',$inicio=0,$cantidad=1){
   return sql2array("
    SELECT id, nombre, apodo, ubicacion, producto_ids, intermediario_id
    FROM proveedores WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_proveedores_contar($criterio='1'){
    return sql2value("
        SELECT COUNT(*)
        FROM proveedores
        WHERE $criterio
    ");
}

function bd_proveedores_dato($id,$campo){
    $sql="SELECT id, $campo  FROM proveedores WHERE id = '$id'";
    return sql2row($sql);
}

function bd_proveedores_datos($id=NULL, $orden='id ASC'){
    if ($id==NULL)    {
        return sql2array("
            SELECT id, nombre, apodo, ubicacion, producto_ids, intermediario_id
            FROM proveedores
            ORDER BY {$orden}");
    }else{
        return sql2row("
            SELECT id, nombre, apodo, ubicacion, producto_ids, intermediario_id
            FROM proveedores
            WHERE id = '$id'
            LIMIT 1");
    }
}

function bd_proveedores_datos2($inicio, $cantidad, $orden='id'){
    return sql2array("
        SELECT * FROM proveedores
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
    ");
}

function bd_proveedores_datos21($campos, $palabras,$cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("
        SELECT * FROM proveedores
        WHERE $condicion
        LIMIT $cantidad
        ");
}

function bd_proveedores_eliminar($id){
   $sql=sql("DELETE FROM proveedores WHERE id = '$id'");
}

function bd_proveedores_existe($id){
   $sql="SELECT COUNT(*) as n FROM proveedores WHERE id = '$id'";
   return sql2value($sql);
}

function bd_proveedores_modificar($d){
   $sql=sprintf("UPDATE proveedores SET nombre = '%s', apodo = '%s', ubicacion = '%s', producto_ids = '%s', intermediario_id = '%s' WHERE id = '$d[id]' LIMIT 1",
$d['nombre'], $d['apodo'], $d['ubicacion'], $d['producto_ids'], $d['intermediario_id']);
   $res=sql($sql);
   return $d['id'];
}

function bd_proveedores_opciones(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM proveedores
      ORDER BY nombre ASC";
   $res=sql2options($sql);
   return $res;
}

function bd_proveedores_opcionesb(){
   $sql="SELECT id, LEFT(nombre,60)
      FROM proveedores
      ORDER BY nombre ASC";
   $res=sql2options($sql);
    $zz=array();
    $zz['--']='';
    foreach($res as $id=>$valor){
       $zz[$id]=$valor;
   }
   return $zz;
}

## usuarios ##
function bd_usuarios_verificar($d){
    $id    = $d['id'];
    $clave = $d['clave'];
    $hash   = sql2value("SELECT clave FROM usuarios WHERE id LIKE '{$d['id']}' LIMIT 1");
        if (password_verify($clave, $hash)) {
            return bd_usuarios_buscar("id='$id'");
        }else{
            return null;
        }
    }

function bd_usuarios_cambiar_clave($d){
    $d['hash'] = cifra_clave($d['clave']);

    return  sql("UPDATE usuarios SET clave = '{$d['hash']}' WHERE id = '{$d['id']}';
");
}

function bd_usuarios_agregar($d){
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

function bd_usuarios_antsig($id){
   $sql  = "SELECT id FROM usuarios WHERE id < '$id' ORDER BY id DESC LIMIT 1";
   $sql2 = "SELECT id FROM usuarios WHERE id > '$id' ORDER BY `id` ASC LIMIT 1";
   $res1 = sql2value($sql);
   $res2 = sql2value($sql2);
   return array('a'=>$res1,'s'=>$res2);
}

function bd_usuarios_buscar($criterio,$orden='id ASC',$inicio=0,$cantidad=1){
   return sql2array("
    SELECT id, clave, nombre, nivel, email, activo
    FROM usuarios WHERE {$criterio}
    ORDER BY $orden
    LIMIT $inicio,$cantidad
   ");
}

function bd_usuarios_contar($criterio='1'){
    return sql2value("
        SELECT COUNT(*)
        FROM usuarios
        WHERE $criterio
    ");
}

function bd_usuarios_dato($id,$campo){
    $sql="SELECT id, $campo  FROM usuarios WHERE id = '$id'";
    return sql2row($sql);
}

function bd_usuarios_datos($id=NULL, $orden='id ASC'){
    if ($id==NULL)    {
        return sql2array("
            SELECT id, clave, nombre, nivel, email, activo
            FROM usuarios
            ORDER BY {$orden}");
    }else{
        return sql2row("
            SELECT id, clave, nombre, nivel, email, activo
            FROM usuarios
            WHERE id = '$id'
            LIMIT 1");
    }
}

function bd_usuarios_datos2($inicio, $cantidad, $orden='id'){
    return sql2array("
        SELECT * FROM usuarios
        ORDER BY $orden ASC
        LIMIT $inicio,$cantidad
    ");
}

function bd_usuarios_datos21($campos, $palabras,$cantidad){
    $miscampos = explode(',', $campos);
    foreach ($miscampos as $key => $value) {
        $miscampos[$key] .= " LIKE '%{$palabras}%'";
    }

    $condicion = implode(' OR ', $miscampos);
    return sql2array("
        SELECT * FROM usuarios
        WHERE $condicion
        LIMIT $cantidad
        ");
}

function bd_usuarios_eliminar($id){
   $sql=sql("DELETE FROM usuarios WHERE id = '$id'");
}

function bd_usuarios_existe($id){
   $sql="SELECT COUNT(*) as n FROM usuarios WHERE id = '$id'";
   return sql2value($sql);
}

function bd_usuarios_modificar($d){
   $sql=sprintf("UPDATE usuarios SET  nombre = '%s', nivel = '%s', email = '%s', activo = '%s' WHERE id = '$d[id]' LIMIT 1",
 $d['nombre'], $d['nivel'], $d['email'], $d['activo']);
   $res=sql($sql);
   return $d['id'];
}

function bd_usuarios_opciones(){
   $sql="SELECT id, LEFT(clave,60)
      FROM usuarios
      ORDER BY clave ASC";
   $res=sql2options($sql);
   return $res;
}

function bd_usuarios_opcionesb(){
   $sql="SELECT id, LEFT(clave,60)
      FROM usuarios
      ORDER BY clave ASC";
   $res=sql2options($sql);
    $zz=array();
    $zz['--']='';
    foreach($res as $id=>$valor){
       $zz[$id]=$valor;
   }
   return $zz;
}
