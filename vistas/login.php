    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    <?php if($data['error']): ?>
                                    <div>
                                    <p class="text-danger">Error: <?php echo $message ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <form method = "POST" action="<?php echo constant('URL').'/login/login' ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputNick" type="text" placeholder="NickName" name="nickname"/>
                                                <label for="inputNick">Nick Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="contrasena" id="inputPassword" type="password" placeholder="Contrasena" />
                                                <label for="inputPassword">Constrasena</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type="submit" value="Login" class="btn btn-primary">
                                                <!--<a class="btn btn-primary" href="<?php echo constant('URL')?>/login/login">Login</a>-->
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="<?php echo constant('URL').'/signin'?>">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="vistas/admin/js/scripts.js"></script>
    </body>
</html>
