<html>
    <body>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'ospedale');

            //inizio elenco farmaci
            $farmaco = $_GET['farmaco'];    
                if(isset($_GET['submit']))
                {        
                    for($i=0; $i < $farmaco; $i++)
                    {
                        $medicinale = $_GET['farmac'.($i+1)];
                        $qta = $_GET['qta'.($i+1)];

                        //prendo il codice del farmaco
                        $sql1 = "SELECT CodFar FROM farmaco WHERE denominazione like '$medicinale';";
                        $ris1 = mysqli_query($conn, $sql1);

                        if($ris1 && mysqli_num_rows($ris1) == 1)
                        {
                            $riga = mysqli_fetch_array($ris1);
                            $CodFar = $riga['CodFar'];


                            //prendo il codice della visita appena inserita.
                            $sql2 = "SELECT MAX(CodVis) as max FROM visita";
                            $ris2 = mysqli_query($conn, $sql2);

                            if($ris2)
                            {
                                $riga2 = mysqli_fetch_array($ris2);
                                $CodVisita = $riga2['max'];

                                //inserimento
                                $sql3 = "INSERT INTO prescrizione values(null, '$CodVisita', '$CodFar', '$qta');";
                                $ris3 = mysqli_query($conn, $sql3);

                                if($ris3) echo "$medicinale inserito con successo <br>";
                                else echo "si e' verificato un problema nell'inserimento";
                            }
                        }
                        else
                        {
                            echo "farmaco non riconosciuto nel DB.";
                        }
                    }          
                } 
                else 
                {
                    echo "<form action = ". $_SERVER['PHP_SELF'] ." method = 'GET'>";
                    for($i = 0; $i < $farmaco; $i++)
                    {
                        echo "<input type = 'text' placeholder = 'farmaco". ($i + 1) ."' name = 'farmac". ($i + 1) ."' value = 'farmac'". $i + 1 ." required>";
                        echo "<input type = 'number' placeholder = 'qta' name = 'qta". ($i + 1) ."' value = '2' required>";
                        echo "<br>";
                    }
                    echo "<input type = 'hidden' name = 'farmaco' value = '$farmaco'>";
                    echo "<input type = 'submit' name = 'submit' value = 'inserisci'>";
                    echo "</form>";
                }                  
            //fine elenco farmaci
        ?>
    </body>
</html>