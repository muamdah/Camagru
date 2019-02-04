<?php
$user_id = $_GET['id'];
$token = $_GET['token'];

$dsn = "mysql:host=db;dbname=myDb;charset=utf8mb4";
$options =[
  PDO::ATTR_EMULATE_PREPARES   => false,
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,];
try{
  $bdd = new PDO($dsn, "user", "test", $options);
}

catch (Exception $e) {
  error_log($e->getMessage());
  exit('Something weird happened');}

  $req = $bdd->prepare('SELECT * FROM USER WHERE id = ?');
  $req->execute([$user_id]);
  $user = $req->fetch();

  if($user && $user['confirmation_token'] == $token){
      session_start();
      $req = $bdd->prepare('UPDATE USER SET confirmation_token = NULL, confirm_at = NOW() WHERE id = ?')->execute([$user_id]);
      $_SESSION['auth'] = $user;
      $_SESSION['flash']['success'] = "Votre compte a bien été confirmé";
      header('Location: profil.php');
      die('ok');
  }
  else{
      session_start();
      $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
      header('Location: Connexion.php');
  }
