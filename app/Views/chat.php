<body class="d-flex flex-column">
  <section class="user margined">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3 offset-left"> <!-- Utilisation de la classe offset-left pour décaler vers la gauche -->
          <img
            src="<?= $_SERVER['BASE_URI'] ?>/assets/img/<?= $viewData['user']->getPicture() ?>"
            class="user-photo rounded-circle"
            alt="Photo de <?= $viewData['user']->getFirstname() ?>"
          />
        </div>
        <div class="col-md-9">
          <div class="media">
            <div class="media-body align-self-center">
              <h5 class="mt-0"><?= $viewData['user']->getFirstname() ?> <?= $viewData['user']->getLastname() ?></h5>
              <!-- Ajoutez d'autres informations ici si nécessaire -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="messages">
    <div class="user-message margined"> <!-- Utilisation de la classe user-message pour décaler vers la gauche -->
      <div class="alert alert-info">
        A simple info alert—check it out!
      </div>
    </div>
    <div class="other-message margined"> <!-- Utilisation de la classe other-message pour décaler vers la droite -->
      <div class="alert alert-light">
        A simple light alert—check it out!
      </div>
    </div>
  </section>
  <section class="send flex-grow-1 d-flex flex-column justify-content-end">
    <div class="form-floating">
      <textarea
        class="form-control"
        placeholder="Leave a comment here"
        id="floatingTextarea"
      ></textarea>
      <label for="floatingTextarea">Message</label>
    </div>
  </section>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</body>
</html>
