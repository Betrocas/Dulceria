<div class="w-75 m-auto">

    <h1 class="text-center mt-5">Clientes</h1>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data['users'] as $cliente): ?>
            <tr>
            <th scope="row"><?php echo $cliente['id'] ?></th>
            <td><?php echo $cliente['nombre'] ?></td>
                <td><?php echo $cliente['apellido'] ?></td>
                <td>
                    <!--<button type="button" class="btn btn-success btn-sm">Success</button>-->
                    <form action="<?php echo constant('URL').'/usuarios/Delete' ?>" method="POST">
                        <input type="hidden" name="Id" value="<?php echo $cliente['id'] ?>">
                          <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                    </form>
                </td>
            </tr>         
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
