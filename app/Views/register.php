<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="text-center mb-4">Nouvel utilisateur</h1>
              <?php if (!empty($viewData['errorList'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($viewData['errorList'] as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
              <?php endif ?>
            <form action="" method="post">
              <div class="mb-3">
                <label for="firstNameInput" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstNameInput" name="firstNameInput">
              </div>
              <div class="mb-3">
                <label for="lastNameInput" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastNameInput" name="lastNameInput">
              </div>
              <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="passwordInput" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="passwordInput" name="passwordInput">
              </div>
              <div class="mb-3">
                <label for="profilePicInput" class="form-label">Photo de profil</label>
                <input type="file" class="form-control-file" id="profilePicInput" name="profilePicInput">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
