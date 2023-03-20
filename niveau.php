<?php
session_start();
if(empty($_SESSION['name'])){
    header('location: index.php');
}
if(isset($_POST['btn'])){
    if(isset($_POST['niveau'])){
        $_SESSION['niveau'] = $_POST['niveau'];
        header('location: qcm.php');
    }else{
        $error = "Veuillez choisir un niveau";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>niveau page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once 'menu.php' ?>
    <section class="niveau">
        <h4>Bonjour <span class="change_color"><?php echo $_SESSION['name'] ?></span> , Choisissez d'abord le niveau des questions :</h4>
        <form action="niveau.php" method="post">
            <p>Votre niveau actuel est : <span class="change_color"><?php if(isset($_SESSION['niveau'])){
                if($_SESSION['niveau'] == 0){
                    echo "Debutant";
                }else{
                    echo "Confirme";
                }
            } ?></span></p>
            <div class="choices">
                <p class="error"><?php if(isset($error)) echo $error ?></p>
                <div class="choix">
                    <input type="radio" name="niveau" value="0">Debutant
                </div>
                <div class="choix">
                    <input type="radio" name="niveau" value="1">Confirme
                </div>
                <input type="submit" name="btn" value="soumettre" class="style_btn">
            </div>
        </form>
    </section>
</body>
</html>