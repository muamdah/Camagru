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
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM USER WHERE id = ?");
    $requser->execute(array($getid));
    $Userinfo = $requser->fetch();
?>
<!DOCTYPE html>
    <header>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montez|Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    </header>
    <body>
        <div class="header">
          
                <div class ="navbar">
                    <div class="logo">
                        <h1><a href="../index.php">Camagru</a></h1>
                    </div>
                    <div class ="menu">
                        <ul>
                            <li> <a href="./deconnection.php">Déconnection</a></li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <h2>Bienvenue dans votre profil <?php echo $Userinfo['FirstName'] ?></h2><br>
                    
                </div>
                <div class="center">
                    <h5>
                    Nom : <?php echo $Userinfo['Name'] ?> <br />
                    Prénom : <?php echo $Userinfo['FirstName'] ?> <br />
                    addresse Email : <?php echo $Userinfo['Email'] ?> <br />
                    <button class="btn btn-secondary btn-sm">Changez votre mot de passe</button>
                    </h5>
                </div>
        </div>
    </body>
    <!-- Footer -->
  
<footer class="footer">
    
    <div class="container col-md-12">© 2018 Muamdah</div>
</footer>
</body>
</html>

</html>
<?php
}
else
{
    header('Location: ,,/index.php');
}
?>