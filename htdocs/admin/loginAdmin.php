<?php
session_start();
include ('../process/db.php');
include ('../process/autoload.php');


if(isset($_POST['login'])){

    $admin_pseudo = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    $sql = 
    "SELECT * 
    FROM admin 
    WHERE name = :name";

    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':name', $admin_pseudo);

    $stmt->execute();
    
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($admin === false){
        header('Location: loginAdmin.php?message=Information(s)erronée(s)');
        exit('Information(s) erronée(s)');
    } else{

    if($passwordAttempt == $admin['password']){
            
            $_SESSION['id'] = $admin['id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['name'] = $admin['name'];
            header('Location: ../index.php');
            exit;
            
        } else{

            header('Location: loginAdmin.php?message=Information(s)erronée(s)');
            exit;

        }
    }
    
}

?>

<form action="loginAdmin.php" id="connexion" method="post">
        
    <br>

    <label>Pseudo : 
    <input name="name" type="text"/></label>

    <br>
    <br>

    <label>Mot de passe : 
    <input name="password" type="password"/></label>

    <br>
    <br>

    <button class="bouton1" name="login" type="submit" value="Login">Connexion</button>

</form>