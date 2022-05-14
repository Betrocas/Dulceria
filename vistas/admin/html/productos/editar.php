<form action="<?php echo constant('URL').'/productos/editar/?p='.$data['producto']['nombre']; ?>" method="POST" class="w-75 m-auto mt-5" >
    <h2 class="m-auto w-50  mb-3">Editar <?php echo $data['producto']['nombre'];?></h2>
    <p class="text-danger">NOTA: No se permite el cambio de nombre, primero debe eliminar este producto y crear uno nuevo con el nombre deseado</p>
    <input type="hidden" class="form-control" id="nombre" name="nombreProducto" value="<?php echo $data['producto']['nombre']; ?>">
    <div class="mb-3 ">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" class="form-control" id="precio" name="precioProducto"  value="<?php echo $data['producto']['precio']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="cantidad" class="form-label">Cantidad</label>
      <input type="number" class="form-control" id="cantidad" name="cantidadProducto" value="<?php echo $data['producto']['cantidad']; ?>">
    </div>
    <div class="mb-3 ">
      <label for="clasificacion" class="form-label">Clasificacion</label>
      <select name="clasificacionProducto" id="clasificacion" class="form-select">
          <?php foreach($data['clasificaciones'] as $clasificacion):?>
              <option value="<?php echo $clasificacion['Id'];?>"<?php if($clasificacion['nombre']==$data['producto']['clasificacion_nombre']){echo 'selected';} ?>><?php echo $clasificacion['nombre']; ?></option>
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
