<html>
    <head>
        <title> inserimento reparto</title>
    </head>

    <body>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
            <input type = 'text' placeholder = 'denominazione reparto' name = "rep" required>
            <input type = "SUBMIT" value = 'INSERISCI' name = "inv">
        </form>

        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'ospedale');
            if($conn)
            {
                if(isset($_POST['inv']))
                {
                    $rep = $_POST['rep'];
                    if(trim($rep) == "") echo "campo vuoto";
        
                    else{
                        $sql = "insert into reparto values(null, '$rep');";
                        $ris = mysqli_query($conn, $sql);

                        if($ris)
                        {
                            echo "inserimento effettuato";
                        }
                    }
                }
                mysqli_close($conn);
            }
            
        ?>
    </body>
</html>