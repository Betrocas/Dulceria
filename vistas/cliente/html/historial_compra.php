<div class="w-75 m-auto mt-4 text-center">
    <h3>Id:</h2>
    <br>
    <h4>fecha:</h2>
</div>
<div class="w-75 m-auto mt-4 ">
<?php if($data): ?>
<table class="table w-50 m-auto mt-3">
  <thead>
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($data['productos'] as $producto): ?>
    <tr>
      <th scope="row"><?php echo $producto['producto'];?></th>
      <td><?php echo $producto['cantidad'];  ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
</div>