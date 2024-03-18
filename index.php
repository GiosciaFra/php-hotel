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


if (($_GET['filtroParcheggio']) || ($_GET['filtroVoto'])) {

    // Filtro gli hotel in base alla presenza di parcheggio e al voto minimo
    $filteredHotels = array_filter($hotels, function ($hotel) {

        // Verifico se il filtro per il parcheggio è attivo
        $filtroParcheggioAttivo = ($_GET['filtroParcheggio']);

        // Verifico se è stato inserito un voto minimo nel filtro
        $filtroVoto = ($_GET['filtroVoto']) ? $_GET['filtroVoto'] : null;

        // Verifico se l'hotel soddisfa i criteri di filtro
        if ($filtroParcheggioAttivo && $filtroVoto !== null) {
            return $hotel['parking'] && $hotel['vote'] >= $filtroVoto;

        } elseif ($filtroParcheggioAttivo) {
            return $hotel['parking'];

        } elseif ($filtroVoto !== null) {
            return $hotel['vote'] >= $filtroVoto;

            // Se clicco 'cerca' senza applicare filtri, non visualizza due volte la stessa lista 
        } elseif ($filtroParcheggioAttivo && $filtroVoto == null) {
            return '';

        } else {
            return true;
        }
    });

}




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

    <div class="container d-flex flex-column align-items-center my-5 p-1 bg-body-tertiary gap-2 ">
        <h1 class="text-danger fw-bold ">Elenco Hotel</h1>

        <!-- Form per filtrare gli hotel-->
        <form method="GET" class="d-flex justify-content-center align-items-center flex-column gap-3 ">
            <div class="form-group">
                <label for="filtroParcheggio" class=" fw-bolder ">Mostra solo hotel con parcheggio</label>
                <input type="checkbox" id="filtroParcheggio" name="filtroParcheggio" value="true">
            </div>

            <div class="form-group">
                <label for="filtroVoto" class=" fw-bolder ">Filtra per voto minimo (da 1 a 5)</label>
                <input type="number" id="filtroVoto" name="filtroVoto" min="1" max="5">
            </div>

            <button type="submit"
                class="btn border border-4 border-info-subtle bg-warning-subtle fw-bold  ">Cerca</button>

        </form>

        <br>

        <table class="table">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Nome Hotel</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro (km)</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $hotel): ?>
                    <tr class="table-info">
                        <td>
                            <?php echo $hotel['name']; ?>
                        </td>
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



        <?php
        // se "filteredHotels" non è vuoto mostra il risultato, altrimenti non mostra nulla
        if (!empty ($filteredHotels)) {
            ?>

            <div class="container d-flex flex-column align-items-center py-5 p-1 ">

                <h1 class="pb-4 text-danger fw-bold ">Risultati del filtro</h1>
                <table class="table">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">Nome Hotel</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Parcheggio</th>
                            <th scope="col">Voto</th>
                            <th scope="col">Distanza dal centro (km)</th>
                        </tr>
                    </thead>
                    <?php foreach ($filteredHotels as $hotel): ?>
                        <tbody>
                            <tr class="table-info">

                                <td>
                                    <?php echo $hotel['name']; ?>
                                </td>
                                <td>
                                    <?php echo $hotel['description']; ?>
                                </td>
                                <td>
                                    <?php echo $hotel['parking'] ? 'Disponibile' : 'Non disponibile'; ?>
                                </td>
                                <td>
                                    <?php echo $hotel['vote']; ?>
                                </td>
                                <td>
                                    <?php echo $hotel['distance_to_center']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
        }
        ?>

        </div>








        <!-- Script Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>