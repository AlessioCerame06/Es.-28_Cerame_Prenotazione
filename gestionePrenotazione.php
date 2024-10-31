<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <style>
            .stileTabella {
                border: solid, black, 2px;
                border-collapse: collapse;
            }
        </style>
        <?php
            function stampaTabella ($nome, $cognome, $nTavoli, $orario, $note, $antipasto, $primo, $secondo, $parcheggio, $listaCamerieri) {
                $prezzo = 0;
                if ($antipasto == "antipasto") {
                    $prezzo += 5;
                }
                if ($primo == "primo") {
                    $prezzo += 6;
                }
                if ($secondo == "secondo") {
                    $prezzo += 7;
                }
                if ($primo == "primo" and $secondo == "secondo" and $antipasto == false) {
                    $prezzo -= ($prezzo/100) * 10;
                    $strPasti = "<td class='stileTabella'>Primo, secondo</td>";
                } else if ($antipasto == "antipasto" and $primo == "primo" and $secondo == "secondo") {
                    $prezzo -= ($prezzo/100) * 15;
                    $strPasti = "<td class='stileTabella'>Antipasto, primo, secondo</td>";
                } else if ($antipasto == "antipasto" and $primo == "primo" and $secondo == false) {
                    $strPasti = "<td class='stileTabella'>Antipasto, primo</td>";
                } else {
                    $strPasti = "<td class='stileTabella'>Antipasto, secondo</td>";
                }

                if ($parcheggio == "parcheggioCostudito") {
                    $prezzo += 5;
                    $strParcheggio = "<td class='stileParcheggio'>Parcheggio costudito</td>";
                } else if ($parcheggio == "parcheggioNonCostudito") {
                    $prezzo += 3;
                    $strParcheggio = "<td class='stileParcheggio'>Parcheggio non costudito</td>";
                } else {
                    $strParcheggio = "<td class='stileParcheggio'>Niente parcheggio</td>";
                }
                $indiceCameriere = rand(0, count($listaCamerieri) - 1);

                $data = date("l jS \of F Y");
                

                echo "<table class='stileTabella'>";
                echo "<tr><th class='stileTabella'>Nome</th> <th class='stileTabella'>Cognome</th> <th class='stileTabella'>N° tavolo</th>
                    <th class='stileTabella'>Cameriere assegnato</th> <th class='stileTabella'>Orario</th> <th class='stileTabella'>Note</th> 
                    <th class='stileTabella'>Pasti</th> <th class='stileTabella'>Prezzo</th> <th class='stileTabella'>Parcheggio</th></tr>";
                echo "<tr><td class='stileTabella'>$nome</td> <td>$cognome</td> <td class='stileTabella'>$nTavoli</td> 
                    <td class='stileTabella'>$listaCamerieri[$indiceCameriere]</td> <td class='stileTabella'>$data" . " $orario</td> 
                    <td class='stileTabella'>$note</td>";
                echo $strPasti;
                echo "<td class='stileTabella'>$prezzo €</td>";
                echo $strParcheggio;
                echo "</str></table>";
            }

            function stampaErrore ($antipasto, $primo, $secondo) {
                if ($antipasto == "antipasto" and $primo == false and $secondo == false) {
                    echo "<p>Errore. Non si puo selezionare solo l'antipasto</p>";
                    echo "<a href='prenotazione.html'>Ritorna alla pagina prenotazioni</a>";
                    return false;
                } else if ($antipasto == false and $primo == false and $secondo == false) {
                    echo "<p>Errore. Deve essere selezionato almeno un pasto</p>";
                    echo "<a href='prenotazione.html'>Ritorna alla pagina prenotazioni</a>";
                    return false;
                }
                return true;
            }

            $listaCamerieri = array("Alessio", "Marco", "Andrea", "Mario", "Simone");
            $nome = $_POST["nome"];
            $cognome = $_POST["cognome"];
            $nTavolo = $_POST["nTavoli"];
            $orario = $_POST["orario"];
            $note = $_POST["note"];
            if (isset($_POST["antipasto"])) {
                $antipasto = $_POST["antipasto"];
            } else {
                $antipasto = false;
            }
            if (isset($_POST["primo"])) {
                $primo = $_POST["primo"];
            } else {
                $primo = false;
            }
            if (isset($_POST["secondo"])) {
                $secondo = $_POST["secondo"];
            } else {
                $secondo = false;
            }
            $parcheggio = $_POST["parcheggio"];
            $esitoPrenotazione = stampaErrore($antipasto, $primo, $secondo);
            if ($esitoPrenotazione) {
                stampaTabella ($nome, $cognome, $nTavolo, $orario, $note, $antipasto, $primo, $secondo, $parcheggio, $listaCamerieri);
            }
        ?>
    </body>
</html>