<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// Filtro gli hotel in base alla presenza del parcheggio
$filteredHotels = array_filter($hotels, function ($hotel) {

    if ($_GET['filtroParcheggio']) {
        return $hotel['parking'];
    }
    return true;
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Elenco Hotel</h1>

        <!-- Form per filtrare gli hotel con parcheggio -->
        <form method="GET">
            <div class="form-group">
                <label for="filtroParcheggio">Mostra solo hotel con parcheggio:</label>
                <input type="checkbox" id="filtroParcheggio" name="filtroParcheggio" value="true">
            </div>
            <button type="submit" class="btn btn-primary">Cerca</button>
        </form>

        <br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome Hotel</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro (km)</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel): ?>
                    <tr>
                        <th>
                            <?php echo $hotel['name']; ?>
                        </th>
                        <td>
                            <?php echo $hotel['description'] ?>
                        </td>
                        <td>
                            <!-- Aggiunto operatore ternario per stampare in pagina "disponibile" se trova 'true' e non "disponibile" se trova 'false' -->
                            <?php echo $hotel['parking'] ? 'Disponibile' : 'Non disponibile'; ?>
                        </td>
                        <td>
                            <?php echo $hotel['vote'] ?>
                        </td>
                        <td>
                            <?php echo $hotel['distance_to_center'] ?>
                        </td>

                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>







    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>