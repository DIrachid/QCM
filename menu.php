<ul class="menu">
        <a href="qcm.php">Refaire le QCM</a>
        <a href="index.php">Changer de pseudo</a>
        <a href="niveau.php">Changer de niveau</a>
        <?php 
        if(isset($_SESSION['name'])){
            ?>
        <a href="deconnexion.php">deconnexion</a>    
            <?php
        }
        ?>
</ul>