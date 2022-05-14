<!--

    En esta vista se ven los datos del cliente:
        *Nombre 
        *Apellidos
    Historial de compra:
        Ultimos 10 productos 
    Saldo de la cuenta

-->


<h2 class="w-25 m-auto mt-5 fs-3">Historial de compras <br><span>(Ultimas 10 compras)</span> </h2>

<?php if($data): ?>
<table class="table w-75 m-auto mt-3">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">fecha</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data['compras'] as $compra):  ?>
    <tr>
      <th scope="row"><a href="<?php echo constant('URL')."/historial/compra?id=".$compra['id']?>"><?php echo $compra['id'];  ?></a></th>
      <td><?php echo $compra['fecha'];  ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif;?>

