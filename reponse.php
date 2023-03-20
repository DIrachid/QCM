<?php
session_start();
if(!isset($_SESSION['name'])){
    header('location: index.php');
}
$niveau = $_SESSION['niveau'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reponse page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once 'menu.php';
          require_once 'database.php'; ?>
    <section class="resultat">
    <h1 class="change_color">Resultat du QCM de <span><?php echo $_SESSION['name'] ?></span></h1>
        <?php
        $somme=0;
        $sqlnote = $con->prepare('select * from questions where niveau=:niveau');
        $sqlnote->bindParam('niveau',$niveau);
        $sqlnote->execute();
        $notes=$sqlnote->rowCount();
        $note=20/$notes;
        foreach($_POST as $ques=>$rep){
            $req =$con->prepare('select * from reponses where idr=:idr and verite = 1');
            $req->bindParam(":idr",$rep);
            $req->execute();
            $count=$req->rowCount();
            $sqlrep = $req->fetchAll();
            if($count > 0){
                $somme += $note;
            }else{
                ?>
            <p class="color">tu t'es plante a la question :<?php echo $ques ?></p>
            <?php
                $sqlerror = $con->prepare('select * from questions where idq=:idq and niveau=:niveau');
                $sqlerror->bindParam(':idq',$ques);
                $sqlerror->bindParam(':niveau',$niveau);
                $sqlerror->execute();
                $questions = $sqlerror->fetch();
                ?>
                <p class="question_error"><?php echo $questions['libelleQ'] ?></p>
                <?php
                $sqlvrai = $con->prepare('select * from reponses where idq=:idq and verite = 1');
                $sqlvrai->bindParam(':idq',$ques);
                $sqlvrai->execute();
                $vrai = $sqlvrai->fetch();
                ?>
                <p class="reponse_vrai"><?php echo $vrai['libeller'] ?></p>
                <?php
            }
        }
        ?>
        <?php
        if($somme < 10){
            echo "<style>.note_value{color:red}</style>";
        }elseif($somme == 10){
            echo "<style>.note_value{color:orange}</style>";
        }else{
            echo "<style>.note_value{color:green}</style>";
        }
        ?>
        <p class="note">tu as eu: <span class="note_value"><?php echo $somme ?></span>/20</p>
    </section>
</body>
</html>