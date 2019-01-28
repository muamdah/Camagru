<?php
session_start();
?>
<!DOCTYPE html>
    <header>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montez|Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    </header>
    <body>
        <div class="header">
            <div class ="container-fluid">
                <div class ="navbar">
                    <div class="logo">
                        <h1><a href="./index.php">Camagru</a></h1>
                    </div>
                    <div class ="menu">
                        <ul>
                            <li> <a href="./srcs/inscription.php">Inscription</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class ="container">
            <div class="middle">
                <h1>Connectez-vous !</h1>
                <a  href="./srcs/Connexion.php">
                <button class="btn btn-primary" type="submit"><span class="lnr lnr-earth" ></span></button>
                    </a>
            </div>
            <div>
            <img src ="./img/phone.png" class ="img-resize">
                </div>

        </div>



    </body>
    <!-- Footer -->
  
<footer class="footer">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
                © 2018 Copyright
       </div>
    </div>
  </div>
</footer>
</body>
</html>

</html>