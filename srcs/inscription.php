<?php
        include('server.php');

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
                <div class="col-md-4 mb-3">
                    <label for="validationServer01">Prénom</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Prénom" required>
                
                </div>
                 <!----------------------------------------   NOM DE FAMILLE     ----------------------------------------->
                    <div class="col-md-4 mb-3">
                    <label for="validationServer02">Nom</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Nom" required>
                </div>
                 <!----------------------------------------     PSEUDO USERMANE    ----------------------------------------->
                <div class="col-md-4 mb-3">
                    <label for="validationServerUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" required> 
                    </div>
                </div>
            </div>
            <div class="form-row">
             <!------------------------------------------      ADDRESSE EMAIL        -------------------------------------->
                <div class="col-md-12 mb-12">
                    <label for="validationServer03">Email</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Email@domain.com" required>
                </div>
            </div>
            <div class="form-row">
             <!--------------------------------------------     PASSWORD    ------------------------------------------------->
                <div class="col-md-6 mb-6">
                    <label for="validationServer03">Creer votre mot de passe</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Mot de passe" required>
                </div> 
             <!----------------------------------------   CONFIRMATION PASSWORD   ----------------------------------------->
                <div class="col-md-6 mb-6">
                    <label for="validationServer03">Confirmation mot de passe</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Mot de passe" required>
                </div>   
            </div>
           
            <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
        </form>
    </div>
</body>
