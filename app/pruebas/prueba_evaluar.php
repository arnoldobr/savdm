<?php
include '../configs/funciones_sistema.php';

prueba_evaluar('$SM*12/52*0.04', ['SM'=>3703350]);
prueba_evaluar('$SD*12/52*0.04', ['SD'=>50]);
prueba_evaluar('$SD*)(12/52*0.04', ['SD'=>50]);
prueba_evaluar('$SM*12/52*0.04', ['SM'=>10]);
prueba_evaluar('$SM*(1+$SM)/pow($SD,3)', ['SD'=>370,'SS'=>22222,'SM'=>12345678]);

