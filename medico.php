<html>
    <head>
        <title> inserimento dei dati del medico </title>
    </head>

    <body>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type = "text" placeholder = "nome" name = 'nome' required>
            <input type = "text" placeholder = "cognome" name = 'cognome' required>
            <input type = "submit" value = "INSERISCI" name = 'inserisci'>
        </form>

        <?php
            //instaurazione connessione.
            $conn = mysqli_connect('localhost', 'root', '','ospedale');

            if($conn)
            {
                if(isset($_POST['inserisci']))
                {
                    $nome = $_POST['nome'];
                    $cognome = $_POST['cognome'];

                    $sql1 = "SELECT * FROM medico WHERE nome = '$nome' AND cognome = '$cognome'";
                    $ris1 = mysqli_query($conn, $sql1);

                    if(mysqli_num_rows($ris1) == 0)
                    {
                        if((trim($nome) == "") || (trim($cognome) == "")) exit("hai lasciato un campo vuoto");
                        
                        $sql2 = "INSERT INTO medico values(null, '$nome', '$cognome');";
                        $ris2 = mysqli_query($conn, $sql2);
                        if($ris2) echo "inserimento effettuato";
                    }
                    else echo "hai gia' inserito questo medico";
                }
                mysqli_close($conn);
            }
        ?>
    </body>
</html>