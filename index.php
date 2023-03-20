<?php 
// start la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_POST['btn'])){
        if(isset($_POST['name']) && $_POST['name'] != ""){
            $_SESSION['name'] = $_POST['name'];
            header('location: qcm.php');
        }else{
            $error = "Veuillez enterez un pseudo";
        }
    }
    ?>
    <?php include_once 'menu.php' ?>
    <section class="pesudo">
        <form action="index.php" method="post">
            <p class="error"><?php if(isset($error)) echo $error ?></p>
            <label for="entre votre pseudo">Entrez votre pseudo</label>
            <input type="text" name="name" id="pseudo" placeholder="Ex: rachid" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?>">
            <input type="submit" value="soumettre" class="style_btn" name="btn">
        </form>
    </section>
</body>
</html>