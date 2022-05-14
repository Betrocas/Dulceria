<!--

    Lista de productos deseados, archivados 
    ordenados en distinta forma

-->
<h1 class="w-25 mt-3  m-auto">Carrito</h1>

<?php if($data['productos']): ?>

<ul class="list-group w-75 m-auto mt-5">
<?php
  foreach($data['productos'] as $producto):
?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="<?php echo constant('URL')."/productos/producto/?p=".$producto['id_producto']; ?>" class="text-primary"><?php echo $producto['id_producto']  ?></a>
    <div class="">
      <span class="badge bg-primary rounded-pill"><?php echo $producto['cantidad']?></span>
      <form action="<?php echo constant('URL').'/carrito/eliminar'?>" method="POST">
          <input type="hidden" name="p" value="<?php echo $producto['id_producto']?>">
          <input type="submit" value="eliminar" class="btn btn-danger">
      </form>
    </div>
  </li>
<?php endforeach; ?>
<div class="">
  <a href="<?php echo constant('URL').'/compra/compra' ?>" class="btn btn-success m-3">Comprar</a>
</div>
</ul>
<?php else: ?>

<div class="w-75 m-auto mt-5 mb-5">

  <h5 class="text-center">Esto se ve muy vacio <br>
   visita nuestro catalogo y empieza a comprar</h5>
   <a href="<?php echo constant('URL')."/productos" ?>" class="btn btn-primary text-center">Catalogo</a>

</div>
<?php endif; ?>
