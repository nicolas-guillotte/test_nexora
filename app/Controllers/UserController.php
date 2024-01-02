<?php

class UserController extends CoreController
{

  public function login()
  {
      $userModel = new User();
      $users = $userModel->findAll();

      $this->show('login', [
          "pageTitle" => "Nexora - Connexion",
          "users" => $users
      ]);
  }

  public function register()
  {
      $userModel = new User();
      $users = $userModel->findAll();

      $this->show('register', [
          "pageTitle" => "Nexora - Création",
          "users" => $users
      ]);
  }

  public function insert($params)
  {
      global $router;
  
      $userModel = new User();
  
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          function cleanString($input) {
              return strip_tags($input);
          }
  
          $firstName = cleanString($_POST['firstNameInput']);
          $lastName = cleanString($_POST['lastNameInput']);
        
          $email = filter_input(INPUT_POST, 'emailInput', FILTER_VALIDATE_EMAIL);
          $password = password_hash($_POST['passwordInput'], PASSWORD_DEFAULT); // Hachage du mot de passe
  
          $user = new User();
          $user->setFirstName($firstName);
          $user->setLastName($lastName);
          $user->setEmail($email);
          $user->setPassword($password);

          $picturePath = $_POST['profilePicInput'];
          $user->setPicture($picturePath);
  
          $success = $userModel->insert($user);
  
          if($success) {
            // Redirection vers la page d'accueil
            $homeUrl = $router->generate('home');
            $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $homeUrl;
            header('Location: ' . $absoluteUrl);
            exit;
        } else {
            $errorList[] = "Erreur lors de l'ajout.";
        }
      }
  
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

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            $error = [];

            if ($user) {
                $hashedPassword = $user->getPassword();
                if (password_verify($password, $hashedPassword)) {

                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_email'] = $user->getEmail();

                    $homeUrl = $router->generate('home');
                    $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $homeUrl;
                    header('Location: ' . $absoluteUrl);
                    exit;
                } else {
                    $error = "Mot de passe incorrect. Veuillez réessayer.";
                }
            } else {
                $error = "Aucun utilisateur trouvé avec cette adresse e-mail.";
            }
        }

        $this->show('login', [
            "pageTitle" => "Nexora - Connexion",
            "error" => $error
        ]);
    }

    public function logout()
    {
        global $router;
    
        session_destroy();
    
        $loginUrl = $router->generate('login');
        $absoluteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $loginUrl;
        header('Location: ' . $absoluteUrl);
        exit;
    }
    
  
}
