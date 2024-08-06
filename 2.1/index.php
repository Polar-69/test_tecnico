<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertidor de Números</title>
</head>
<body>
    <h1>Convertidor de Números Arábigos a Romanos</h1>
    
    <form method="post" action="">
        <label for="numArabic">Número Arábigo:</label>
        <input type="number" id="numArabic" name="numArabic">
        <button type="submit">Convertir</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once 'converter.php';

        $numberConverter = new converterNumber();
     
            $numArabic = intval($_POST["numArabic"]);
            $numRomano = $numberConverter->converterToRoman($numArabic);
            echo "<p>Número Romano: $numRomano</p>";
         
            $numRoman = strtoupper(trim($numRomano));
            $numArabic = $numberConverter->converterToArabic($numRoman);
            echo "<p>Número Arábigo: $numArabic</p>";
     
    }
    ?>
</body>
</html>

