<div class="w-75 m-auto mt-5" >
    <h2 class="text-center mt-5">Productos</h2>
    <table class="table table-hover mt-5">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Clasificacion</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($data['productos'] as $key => $value): ?>
            <tr>
            <th scope="row"><a  class="text-decoration-none text-dark" href="<?php echo constant('URL')."/productos/producto/?p=".$value['nombre']; ?>"><?php echo $value['nombre']; ?></a></th>
              <td><?php echo $value['precio']; ?></td>
              <td><?php echo $value['cantidad']; ?></td>
              <td><?php echo $value['clasificacion']; ?></td>
            </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
