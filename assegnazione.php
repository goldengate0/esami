<html>
    <head> 
        <title>compilazione assegnazione </title>
    </head>

    <body>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
            <input type = "number" placeholder = "medico" name = "medico" required>
            <input type = "number" placeholder = "reparto" name = "reparto" required>
            <input type = "SUBMIT" name = "submit" value = "inserisci">
        </form>

        <?php
            $conn = mysqli_connect("localhost", "root", "", "ospedale");
            if($conn)
            {
                if(isset($_POST['submit'])) {
                    $medico = $_POST['medico'];
                    $reparto = $_POST['reparto'];

                    $sql1 = "INSERT INTO assegnazione values(null, '$medico', '$reparto');";
                    $ris1 = mysqli_query($conn, $sql1);

                    if($ris1) echo "inserimento effettuato";
                    else echo "inserimento NON effettuato";
                }
            }
        ?>
    </body>
</html>