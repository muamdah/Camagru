<?php

session_start();
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
if(isset($_POST['submit']))
{
    if(!empty($_POST['FirstName']) AND !empty($_POST['Name']) AND !empty($_POST['Email']) AND !empty($_POST['Password']) AND !empty($_POST['Password2']))
    {
        if(preg_match('/^[a-zA-Z_]+$/', $_POST['FirstName']) && preg_match('/^[a-zA-Z_]+$/', $_POST['Name']))
        {
            $FirstName = htmlspecialchars($_POST['FirstName']);
            $Name = htmlspecialchars($_POST['Name']);
            $Email = htmlspecialchars($_POST['Email']);
            $mdp = sha1($_POST['Password']);
            $mdp2 = sha1($_POST['Password2']);

            $FirstNamelenght = strlen($FirstName);
            $Namelenght = strlen($Name);
            if($FirstNamelenght <= 255 AND $Namelenght <= 255)
            {
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT * FROM USER WHERE Email = ?");
                    $reqmail->execute(array($Email));
                    $Emailexist = $reqmail->rowcount();
                    if($Emailexist == 0)
                    {
                        if($mdp == $mdp2)
                        {
                            $insert = $bdd->prepare("INSERT INTO USER(FirstName, Name, Email, Password, confirmation_token) VALUES(?, ?, ?, ?, ?)");
                            require_once 'function.php';
                            $token = str_random(60);
                            $insert->execute(array($FirstName, $Name, $Email, $mdp, $token));
                            $user_id = $bdd->lastInsertId();
                            mail($Email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttps://192.168.99.100/srcs/confirm.php?id=$user_id&token=$token");
                            $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé";
                            header('Location: ../index.php');
                            exit();
                        }
                        else
                        {
                            $erreur = "Vos mot de passe sont differents !";
                        }
                    }
                    else
                    {
                        $erreur = "Votre address mail est deja utilisée !";
                    }
                }
                else
                {
                    $erreur = "Veuillez entrez une address valide !";
                }
            }
            else
            {
                $erreur = "Votre prénom ou nom ne doit pas depasser 255 caractères !";
            }
        }
        else
        {
            $erreur = "Votre nom ou prénom n'est pas valide !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent etre remplis !";
    }
}
  ?>

<!DOCTYPE html>
<header>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montez|Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</header>
<body>
    <div class="header">
        <div class ="container-fluid">
            <div class ="navbar">
                <div class="logo">
                
                    <h1><a href="../index.php">Camagru</a></h1>
                </div>
                <div class ="menu">
                    <ul>
                        <li> <a href="../index.php">Home</a></li>
                        <li> <a href="./Connexion.php">Connexion</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container">
        <form method="post" action="inscription.php">
            <div class="form-row">
                <!----------------------------------------       PRENOM         ----------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Prénom</label>
                    <input type="text" class="form-control" name="FirstName" placeholder="Prénom" >
                
                </div>
                 <!----------------------------------------   NOM DE FAMILLE     ----------------------------------------->
                    <div class="col-md-6 mb-3">
                    <label for="validationServer02">Nom</label>
                    <input type="text" class="form-control" name="Name" placeholder="Nom" >
                </div>
                 <!----------------------------------------     PSEUDO USERMANE    ----------------------------------------->
                
            </div>
            <div class="form-row">
             <!------------------------------------------      ADDRESSE EMAIL        -------------------------------------->
                <div class="col-md-12 mb-3">
                    <label for="validationServer03">Email</label>
                    <input type="text" class="form-control" name="Email" placeholder="Email@domain.com" >
                </div>
            </div>
            <div class="form-row">
             <!--------------------------------------------     PASSWORD    ------------------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Creer votre mot de passe</label>
                    <input type="password" class="form-control" name="Password" placeholder="Mot de passe" >
                </div> 
             <!----------------------------------------   CONFIRMATION PASSWORD   ----------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Confirmation</label>
                    <input type="password" class="form-control" name="Password2" placeholder="Mot de passe" >
                </div>   
            </div>
           
            <button class="btn btn-secondary" type="submit" name="submit">Submit form</button>
        </form>
        <?php
        if(isset($erreur))
        {
            echo '<font class="container">'.$erreur.'</font>';
        }
        ?>
    </div>

<footer class="footer">
  <div class="container col-md-12">© 2018 Muamdah</div>
</footer>
</body>
</html>
