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
    $Email = htmlspecialchars($_POST['Emailconnect']);
    $mdp = sha1($_POST['Passwordconnect']);
    if(!empty($Email) AND !empty($mdp))
    {
        if(filter_var($Email, FILTER_VALIDATE_EMAIL))
        {
            $requser = $bdd->prepare("SELECT * FROM USER WHERE Email = ? AND Password = ?");
            $requser->execute(array($Email, $mdp));
            $Userexist = $requser->rowcount();
            if($Userexist == 1)
            {
                $Userinfo = $requser->fetch();
                $_SESSION['id'] = $Userinfo['id'];
                $_SESSION['FirstName'] = $Userinfo['FirstName'];
                $_SESSION['Email'] = $Userinfo['Email'];
                $_SESSION['Name'] = $Userinfo['Name'];
                header('Location: ./profil.php?id='.$_SESSION['id']);
            }
            else
            {
                $erreur = "Address mail ou mot de passe incorrect";
            }
        }
        else
        {
            $erreur = "Veuillez inserez une adresse valide !";
        }
    }
    else
    {
        $erreur = "Veuillez inserez tous les champs !";
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
                                <li> <a href="./inscription.php">Inscription</a></li>
                            </ul>
                        </div>
                     
                    </div>
                </div>
            </div>
            <div class ="container">
                <h1 class ="middle">Connexion</h1>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Addresse Email</label>
                        <input type="email" class="form-control" name="Emailconnect" aria-describedby="emailHelp" placeholder="Enter email">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mot de passe</label>
                        <input type="password" class="form-control" name="Passwordconnect" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-secondary" name="submit">Validez</button>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="yellow">'.$erreur.'</font>';
                }
                ?>
            </div>
    
       
        <footer class="footer">
            <div class="container col-md-12">© 2018 Muamdah</div>
        </footer>
    </body>
</html>