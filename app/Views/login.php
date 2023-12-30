<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="text-center mb-4">Connexion</h1>
            <form action="" method="post">
              <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="passwordInput" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="passwordInput" name="password">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
            <?php if (isset($error)) : ?>
                <!-- Display the error message -->
                <div class="alert alert-danger mt-3">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <div class="text-center mt-3">
              <p>Vous n'avez pas de compte ?</p>
              <a href="<?= $router->generate('register') ?>" class="btn btn-secondary">Créer un compte</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
