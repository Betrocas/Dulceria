<form action="<?php echo constant('URL').'/clasificacion' ?>" class="w-75 m-auto mt-5" method="POST" >
    <h2 class="m-auto w-50  mb-3">Registro clasificación</h2>
<?php 
if(isset($message)){
  echo "<p>$message</p>";
}
?>
    <div class="mb-3 ">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombreClasificacion">
    </div>
    <input type="submit" value="Guardar" class="c-primary">
</form>

