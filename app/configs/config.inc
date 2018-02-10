[debug]
debug = NO

[paginacion]
num_items = 100

[ajax]
num_items = 20

[mascaras]
m1 = "
<div class='form-group'>
  <label class='control-label' for='%name'>%title% %seperator%</label>
  <div>
    %field%
    <span class='help-block'>%help%</span>
    %error%
  </div>
</div>
"

m2 = "
<div class = 'form-group'>
  <label class='control-label' for='%name'>%title% %seperator%</label>%field%
    <span class='help-block'>%help%</span>
    %error%
</div>
"



mlogin= "
<!-- Prepended text-->
<div class="row">
<div class='form-group'>
    <div class='input-group'>
      <span class='input-group-addon'><i class='fa fa-user' aria-hidden='true'></i></span>
      <!--input id='usuario' name='usuario' class='form-control' placeholder='Usuario' required='' type='text'-->
      %field%
    </div>
    <p class='help-block'>%help%</p>
</div>

<div class='form-group'>
    <div class='input-group'>
      <span class='input-group-addon'><i class='fa fa-key' aria-hidden='true'></i></span>
      %field%
      <!-- input id='clave' name='clave' class='form-control' placeholder='Clave del usuario' required='' type='text' -->
    </div>
    <p class='help-block'>%help%</p>

	<!-- button id='btn_continuar' name='btn_continuar' class='btn btn-primary'>Ingresar</button-->
    %field%
  </div>

</div>
"




[bd]
host  = localhost
login = savdm
clave = savdm
bd    = savdm

[conf]
iva = 12.5

