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
                        $insert = $bdd->prepare("INSERT INTO USER(FirstName, Name, Email, Password) VALUES(?, ?, ?, ?)");
                        $insert->execute(array($FirstName, $Name, $Email, $mdp));
                        $_SESSION['comptecree'] = "Votre compte à été crée veuillez vous connectez";
                        header('Location: ../index.php');
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
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="post" action="inscription.php">
            <div class="form-row">
                <!----------------------------------------       PRENOM         ----------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Prénom</label>
                    <input type="text" class="form-control is-valid" name="FirstName" placeholder="Prénom" required>
                
                </div>
                 <!----------------------------------------   NOM DE FAMILLE     ----------------------------------------->
                    <div class="col-md-6 mb-3">
                    <label for="validationServer02">Nom</label>
                    <input type="text" class="form-control is-valid" name="Name" placeholder="Nom" required>
                </div>
                 <!----------------------------------------     PSEUDO USERMANE    ----------------------------------------->
                
            </div>
            <div class="form-row">
             <!------------------------------------------      ADDRESSE EMAIL        -------------------------------------->
                <div class="col-md-12 mb-3">
                    <label for="validationServer03">Email</label>
                    <input type="text" class="form-control is-invalid" name="Email" placeholder="Email@domain.com" required>
                </div>
            </div>
            <div class="form-row">
             <!--------------------------------------------     PASSWORD    ------------------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Creer votre mot de passe</label>
                    <input type="text" class="form-control is-invalid" name="Password" placeholder="Mot de passe" required>
                </div> 
             <!----------------------------------------   CONFIRMATION PASSWORD   ----------------------------------------->
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Confirmation mot de passe</label>
                    <input type="text" class="form-control is-invalid" name="Password2" placeholder="Mot de passe" required>
                </div>   
            </div>
           
            <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
        </form>
    <?php
    if(isset($erreur))
    {
        echo '<font color="yellow">'.$erreur.'</font>';
    }
    ?>
    </div>
</body>
