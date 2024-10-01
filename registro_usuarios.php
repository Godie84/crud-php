<div class="container text-dark">
  <form id="regiration_form" action="" method="post" enctype="multipart/form-data">
              <div class="col-12">
                <button value="btnRegistrar" onclick="return validarCamposUsers()" <?php echo $accionAgregar; ?> type="submit" name="accion" class="btn btn-success btn-sm">Registrar</button>
                <button value="btnModificar" onclick="return Confirmar('¿Desea modificar este elemento?');" <?php echo $accionModificar; ?> type="submit" name="accion" class="btn btn-warning btn-sm">Modificar</button>
                <button value="btnEliminar" onclick="return Confirmar('¿Desea eliminar este elemento?');" <?php echo $accionEliminar; ?> type="submit" name="accion" class="btn btn-danger btn-sm">Eliminar</button>
                <!--<button value="btnCancelar" <?php echo $accionCancelar; ?> type="submit" name="accion" class="btn btn-primary btn-sm">Cancelar</button>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div><br>
<div class="container text-dark">
  <div class="card rounded-40" style="padding: 2rem;">
    <!-- Título centralizado -->
    <div class="row">
      <div class="col-12 text-center mb-3">
        <h3 class="modal-title">
          <font style="color: #000000;">ADMINISTRADOR DE USUARIOS</font>
        </h3>
      </div>
    </div>
    <!-- Formulario con elementos en línea -->
    <div class="row">
      <form action="" method="POST" style="width: 100%; margin-bottom: 1.5rem;">
        <div class="d-flex justify-content-between align-items-end w-100">
          <div class="form-group w-50">
            <label for="cedula" class="form-label">Busqueda por cédula o nombre</label>
            <input type="text" id="cedula" name="cedula" class="form-control form-control-sm" onkeyup="fetchResults()">
          </div>
          <div class="form-group ml-3">
            <button type="button" onclick="mostrarSelect();" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
              Nuevo registro +
            </button>
          </div>
        </div>
      </form>
    </div>
    <!-- Tabla de Resultados -->
    <div id="results"></div>
  </div>
</div>
<script>
  function fetchResults() {
    const cedula = document.getElementById('cedula').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controlador/buscar_registros.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('results').innerHTML = xhr.responseText;
      }
    };

    xhr.send('cedula=' + encodeURIComponent(cedula));
  }
</script>

<?php if ($mostrarModal) { ?>
  <script>
    $('#exampleModal').modal('show');
  </script>
<?php } ?>
<?php include("./plantillas/footer.php"); ?>
</body>

</html>