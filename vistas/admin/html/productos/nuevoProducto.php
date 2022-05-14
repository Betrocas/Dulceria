<div class="w-75 m-auto">
<?php if(!empty($message)): ?>
<div class="bg-primary w-50 m-auto p-2">
  <p class="text-center fs-5 text-light">
  <?php 
     echo $message;
   ?>
  </p>
</div>
<?php endif; ?>
<form action="<?php echo constant('URL').'/productos/registro' ?>" method="POST" class="w-75 m-auto mt-5" >
    <h2 class="m-auto w-50  mb-3">Nuevo Producto</h2>
    <div class="mb-3 ">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombreProducto">
    </div>
    <div class="mb-3 ">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" class="form-control" id="precio" name="precioProducto">
    </div>
    <div class="mb-3 ">
      <label for="clasificacion" class="form-label">Clasificacion</label>
      <select name="clasificacionProducto" id="clasificacion" class="form-select">
      <?php foreach($data as $key => $value): ?> 
        <option value="<?php echo $value['Id']; ?>"><?php echo $value['nombre'] ?></option>
      <?php endforeach; ?>
      </select>

    </div>
    <!--<div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion</label>
      <textarea class="form-control" id="descripcion" name="descripcionProducto" rows="3"></textarea>
    </div>-->
    <input type="submit" value="Guardar" class="btn btn-success">
</form>
<script src="<?php echo constant('URL') ?>/vistas/js/avoid_resubmit.js"></script>
</div>
