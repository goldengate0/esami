<html>
    <body>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'ospedale');
            if($conn)
            {
                $sql1 = "SELECT f.denominazione as denominazione, SUM(p.qta) as qta
                        FROM prescrizione as p, visita as v, assegnazione as a, reparto as r, farmaco as f
                        WHERE p.codvis = v.codvis AND p.codfar = f.codfar AND v.codass = a.codass AND a.codrep = r.codrep AND v.data = CURDATE()
                        GROUP BY f.denominazione;";
                $ris1 = mysqli_query($conn, $sql1);
                
                echo "<table border = '1'>";
                echo "<th> denominazione </th><th> qta </th>";
                foreach($ris1 as $riga)
                {        
                    echo "<tr>";
                    echo "<td>". $riga['denominazione'] ."</td>";
                    echo "<td>". $riga['qta'] ."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    <body>
</html>