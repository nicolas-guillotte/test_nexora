<?php

class UserController extends CoreController
{

  public function login()
  {
      // on a besoin de la liste des utilisateurs
      $userModel = new User();
      $users = $userModel->findAll();

      // on appelle la méthode show pour afficher notre vue
      $this->show('login', [
          "pageTitle" => "Nexora - Connexion",
          "users" => $users
      ]);
  }

  public function register()
  {
      // on a besoin de la liste des utilisateurs
      $userModel = new User();
      $users = $userModel->findAll();

      // on appelle la méthode show pour afficher notre vue
      $this->show('register', [
          "pageTitle" => "Nexora - Création",
          "users" => $users
      ]);
  }

  public function insert($params)
  {
      global $router;
  
      // Instanciation du modèle utilisateur en dehors de la condition
      $userModel = new User();
  
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Récupérer les données du formulaire
          function cleanString($input) {
              // Implémentez votre logique de nettoyage des chaînes ici
              // Par exemple, vous pouvez utiliser strip_tags, htmlentities, etc.
              return strip_tags($input);
          }
  
          $firstName = cleanString($_POST['firstNameInput']);
          $lastName = cleanString($_POST['lastNameInput']);
        
          $email = filter_input(INPUT_POST, 'emailInput', FILTER_VALIDATE_EMAIL);
          $password = password_hash($_POST['passwordInput'], PASSWORD_DEFAULT); // Hachage du mot de passe
  
          // Autres vérifications de validation si nécessaire
  
          // Créer un nouvel utilisateur
          $user = new User();
          $user->setFirstName($firstName);
          $user->setLastName($lastName);
          $user->setEmail($email);
          $user->setPassword($password);

          $picturePath = $_POST['profilePicInput'];
          $user->setPicture($picturePath);
  
          // Insérer l'utilisateur en base de données
          $success = $userModel->insert($user);
  
          if($success) {
            // Redirection vers la page d'accueil
            $homeUrl = $router->generate('home');
            $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $homeUrl;
            header('Location: ' . $absoluteUrl);
            exit;
        } else {
            // ça n'a pas fonctionné, on met un message d'erreur.
            $errorList[] = "Erreur lors de l'ajout.";
        }
      }
  
      // En cas d'erreur ou de requête GET, rediriger vers la page d'inscription
      $this->show('register', [
        "pageTitle" => "Nexora - Création",
        "user" => $user,
    ], $router->generate('register')); // Utilisez $sender_id au lieu de $user->getId() 
  }

    public function connect($params)
    {
        global $router;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            // Validez les données (vous pouvez ajouter plus de validation si nécessaire)

            // Vérifiez si l'utilisateur existe en base de données
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user) {
                // L'utilisateur existe, vérifiez le mot de passe
                $hashedPassword = $user->getPassword();
                if (password_verify($password, $hashedPassword)) {
                    // Authentification réussie

                    // Enregistrez les informations de l'utilisateur en session
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_email'] = $user->getEmail();
                    // Vous pouvez ajouter d'autres informations de l'utilisateur si nécessaire

                    $homeUrl = $router->generate('home');
                    $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $homeUrl;
                    header('Location: ' . $absoluteUrl);
                    exit;
                } else {
                    // Mot de passe incorrect
                    $error = "Mot de passe incorrect. Veuillez réessayer.";
                }
            } else {
                // Utilisateur non trouvé
                $error = "Aucun utilisateur trouvé avec cette adresse e-mail.";
            }
        }

        // En cas d'erreur ou de requête GET, rediriger vers la page de connexion
        $this->show('login', [
            "pageTitle" => "Nexora - Connexion",
            "error" => $error
        ]);
    }

    public function logout()
    {
        global $router;
    
        // Détruire la session
        session_destroy();
    
        // Rediriger vers la page d'accueil ou une autre page après la déconnexion
        $loginUrl = $router->generate('login');
        $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $loginUrl;
        header('Location: ' . $absoluteUrl);
        exit;
    }
    
  
}
