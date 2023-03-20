
<?php
session_start();
if(!isset($_SESSION['name'])){
    header('location: index.php');
}
if(!isset($_SESSION['niveau'])){
    header('location: niveau.php');
}
$niveau = $_SESSION['niveau'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>QCM page</title>
</head>
<body>
    <?php include_once 'menu.php';
          require_once 'database.php';
    ?>
    <section class="qcm">
        <form action="reponse.php" method="post">
            <ol>
                <?php
                $sql = $con->prepare('select * from questions where niveau =:niveau');
                $sql->bindParam(":niveau",$niveau);
                $sql->execute();
                $ques=$sql->fetchAll();
                // that for les input des reponses
                
                ?>
                <h3 class="question">
                    <?php
                    foreach($ques as $que){
                        ?>
                        <li><?php echo $que['libelleQ'] ?></li>
                        <?php
                        $idq = $que['idq'];
                        $sqlinput = $con->prepare('select * from reponses where idq =:idq');
                        $sqlinput->bindParam(":idq",$idq);
                        $sqlinput->execute();
                        $reponses=$sqlinput->fetchAll();
                        foreach($reponses as $rep){
                            ?>
                            <input type="radio" name="<?php echo $idq ?>" value="<?php echo $rep['idr'] ?>" required><?php echo $rep['libeller'] ?> <br>
                            <?php
                        }
                    }
                    
                    ?>
                </h3>
            </ol>
            <input type="submit" value="Envoyer" class="style_btn">
        </form>
    </section>
</body>
</html>