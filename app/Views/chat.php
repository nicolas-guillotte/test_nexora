<body class="d-flex flex-column">
<a href="<?= $router->generate('home') ?>" class="btn btn-success">Retour à l'accueil</a>
  <section class="user margined">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3 offset-left">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="messages">
    <?php foreach ($viewData['messages'] as $message) : ?>
        <div class="<?= ($_SESSION['user_id'] === $message->getSender_id()) ? 'user-message margined' : 'other-message margined'; ?>">
            <div class="<?= ($_SESSION['user_id'] === $message->getSender_id()) ? 'alert alert-info' : 'alert alert-light'; ?>">
                <?= $message->getText(); ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<section class="send flex-grow-1 d-flex flex-column justify-content-end">
    <form action="" method="post">
      <div class="form-floating">
        <textarea
          class="form-control"
          placeholder="Leave a comment here"
          id="floatingTextarea"
          name="message"></textarea>
        <label for="floatingTextarea">Message</label>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
    </form>
</section>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</body>
</html>
