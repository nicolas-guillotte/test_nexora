<body class="d-flex flex-column">

<?php foreach ($viewData["users"] as $user) : ?>

  <section class="user margined">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3 offset-left"> <!-- Utilisation de la classe offset-left pour décaler vers la gauche -->
          <img
            src="<?= $_SERVER['BASE_URI'] ?>/assets/img/<?= $user->getPicture() ?>"
            class="user-photo rounded-circle"
            alt="Photo de <?= $user->getFirstname() ?>"
          />
        </div>
        <div class="col-md-9">
          <div class="media">
            <div class="media-body align-self-center">
              <h5 class="mt-0"><?= $user->getFirstname() ?> <?= $user->getLastname() ?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php endforeach ?>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</body>
</html>
