        <!-- Product section-->
        <p class="text-warning">Esta es solo una vista previa de lo que vera el Usuarios</p>
        <section class="py-5">
            <div class="w-75 m-auto">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="<?php echo constant('URL').'/productos/editar/?p='.$data['nombre']?>">Editar</a>
                </div>
                <div class="d-flex justify-content-end mt-1">
                    <form action="<?php echo constant('URL').'/productos/eliminar'?>" method="POST">
                        <input type="hidden" name="p" value="<?php echo $data['nombre']; ?>">
                        <input type='submit' class="btn btn-danger" value="Eliminar">
                    </form>                    
                </div>
            </div>
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-3">CLASIFICACION: <?php echo $data['clasificacion_nombre'] ?></div>
                        <h1 class="display-5 mb-3 fw-bolder"><?php echo $data['nombre'] ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="mt-3">Cantidad en Stock: <?php echo $data['cantidad'] ?></span>
                            <br>
                             <span class="mt-3">$<?php echo $data['precio'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
