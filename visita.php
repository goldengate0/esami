<html>
    <head>
        <title> inserimento visita medica </title> 
    </head>

    <body>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
            <input type = 'text' placeholder = "annotazioni" name = "annotazioni" required>
            <input type = 'number' placeholder = "pressione minima" name = "min"  value = "20" required>
            <input type = 'number' placeholder = "pressione massima" name = "max" value = "50" required>
            <input type = 'number' placeholder = "temperatura" name = "temperatura" value = "36" required>
            <input type = 'text' placeholder = "nome Medico" name = "nMedico" value = "medico1" required>
            <input type = 'text' placeholder = "cognome Medico" name = "cMedico" value = "medico1" required>
            <input type = 'text' placeholder = "nome Paziente" name = "nPaziente" value = "paziente1"required>
            <input type = 'text' placeholder = "cognome paziente" name = "cPaziente" value = "paziente1" required>
            <input type = 'number' placeholder = "frequenza cardiaca" name = "frequenza" value = "33" required>
            <input type = 'text' placeholder = "reparto" name = "reparto" value = "reparto1" required>
            <input type = 'number' placeholder = "quante medicine bisogna prescrivere?" value = '0' name = "farmaco" required>
            <input type = "SUBMIT" value = "inserisci" name = "submit">
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $conn = mysqli_connect('localhost', 'root', '', 'ospedale');

                $annotazioni = $_POST['annotazioni'];
                $min = $_POST['min'];
                $max = $_POST['max'];
                $temperatura = $_POST['temperatura'];
                $nMedico = $_POST['nMedico'];
                $nPaziente = $_POST['nPaziente'];
                $cMedico = $_POST['cMedico'];
                $cPaziente = $_POST['cPaziente'];
                $frequenza = $_POST['frequenza'];
                $reparto = $_POST['reparto'];
                $farmaco = $_POST['farmaco'];


                if((trim($annotazioni) == "") || (trim($min) == "") || (trim($max) == "") || (trim($temperatura) == "") || (trim($nMedico) == "") || (trim($nPaziente) == "") || (trim($cMedico) == "") || (trim($cPaziente) == "")) exit("hai lasciato un campo vuoto");
                else{
                    //codice medico
                    $sql1 = "SELECT CodMed FROM medico WHERE nome = '$nMedico' and cognome = '$cMedico';";
                    $ris1 = mysqli_query($conn, $sql1);
                    
                    if(mysqli_num_rows($ris1) > 0)
                    {
                        $riga = mysqli_fetch_array($ris1);
                        $codMed = $riga['CodMed'];
                    }
                    else exit("medico non inserito nel DB, <a href = 'medico.php'> registralo qui </a>");


                    //codice reparto
                    $sql2 = "SELECT CodRep FROM reparto WHERE denominazione = '$reparto';";
                    $ris2 = mysqli_query($conn, $sql2);

                    if(mysqli_num_rows($ris2) > 0)
                    {
                        $riga2 = mysqli_fetch_array($ris2);
                        $CodRep = $riga2['CodRep'];

                        //codice associazione
                        $sql3 = "SELECT CodAss FROM assegnazione WHERE CodMed = '$codMed' and CodRep = '$CodRep';";
                        $ris3 = mysqli_query($conn, $sql3);
                        if(mysqli_num_rows($ris3) > 0)
                        {
                            $riga3 = mysqli_fetch_array($ris3);
                            $CodAss = $riga3['CodAss'];
                        }
                        else exit("assegnazione non valida");
                        
                    }
                    else exit("hai inserito un reparto non esistente");
                    
                    //codice paziente
                    $sql4 = "SELECT CodPaz FROM Paziente WHERE nome = '$nPaziente' and cognome = '$cPaziente';";
                    $ris4 = mysqli_query($conn, $sql4);
                    if(mysqli_num_rows($ris4) > 0)
                    {
                        $riga4 = mysqli_fetch_array($ris4);
                        $CodPaz = $riga4['CodPaz'];
                    }
                    else exit("paziente non esistente");
                    
                    $data = date('Y-m-d');
                    $ora = date("H:i");
                    //inserimento nella tabella visita
                    $sql5 = "INSERT INTO visita values(null, '$annotazioni', '$data', '$ora', '$min', '$max', '$temperatura', '$frequenza', '$CodAss', '$CodPaz');";
                    $ris5 = mysqli_query($conn, $sql5);

                    if($ris5){
                        if($farmaco > 0)
                        {
                            header("Location: farmaco.php?farmaco=$farmaco");
                            exit();
                        }
                        else echo "inserimento effettuato";
                        
                    }
                    else echo "mancato inserimento";
                }
            }
        ?>
    </body>
</html>