<html>
    <head>
        <title> inserimento dati paziente </title>
    </head>

    <body>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
            <input type = 'text' placeholder = 'nome' name = "nome" required>
            <input type = 'text' placeholder = 'cognome' name = "cognome" required>
            <input type = 'submit' value = 'INSERISCI' name = "inserisci">
        </form>

        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'ospedale');
            if($conn)
            {
                if(isset($_POST['inserisci']))
                {
                    $nome = $_POST['nome'];
                    $cognome = $_POST['cognome'];

                    $sql2 = "SELECT * FROM paziente WHERE nome = '$nome' AND cognome = '$cognome';";
                    $ris2 = mysqli_query($conn, $sql2);

                    if(mysqli_num_rows($ris2) == 0)
                    {
                       if((trim($nome) == "") || (trim($cognome) == "")) exit("hai lasciato un campo vuoto");    
                        
                        $sql1 = "insert into paziente values(null, '$nome', '$cognome')";
                        $ris1 = mysqli_query($conn, $sql1);

                        if($ris1) echo "inserimento effettuato";   
                    }
                    else echo "paziente gia' inserito";
                              
                }
            }
        ?>
    </body>
</html>