#!/bin/bash

tabla=$1

for x in agregar eliminar ficha lista modificar
do
	cp _$x.html ${tabla}_$x.html
	cp _$x.php ${tabla}_$x.php
done

cp nominas_eliminar2.php ${tabla}_eliminar2.php

mv ${tabla}*.php ../
mv ${tabla}*.html ../templates/
