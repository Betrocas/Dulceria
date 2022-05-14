        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-3">CLASIFICACION: <?php echo $data['clasificacion_nombre'] ?></div>
                        <h1 class="display-5 mb-3 fw-bolder"><?php echo $data['nombre'] ?></h1>
                        <p>Precio: <?php echo '$'.$data['precio'] ?></p>
                    </div>
                </div>
            </div>
            <div class="w-75 m-auto">
                <div class="d-flex justify-content-end mt-1" >
                    <form action="<?php echo constant('URL').'/carrito/agregar'?>" method="POST">
                        <input type="hidden" name="p" value="<?php echo $data['nombre']; ?>">
                        <label for="cantidad" class="">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="w-25 m-3" value=<?php echo $data['cantidad'] ?>>
                        <input type='submit' class="btn btn-success" value="Agregar">
                    </form>                    
                </div>
            </div>
        </section>
