<?php

if(isset($_GET["search"])){

$judul_film = $_GET["search"];

//1. Endpoint
$endpoint = "https://api.themoviedb.org/3/search/movie?query=" . urlencode($judul_film);

// 2. Curl
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5ZDBiNjJlZWVhNWYyMGJjNjg0ZjI3NTMzYTQ1MTU3OSIsIm5iZiI6MTc4OTM1Mjg2Mi43NTUsInN1YiI6IjZhYTc1YjllYmVmZjUwODkxYmE5ODcyYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.LKlg7RXermNdnsiZnWIMtWLHac-dLEMyJ8YB057HPpc',
        'Accept: Application/json'
    ]
]);

$response = curl_exec($curl);

$data = json_decode($response, true);

$result = $data["results"] ?? [];

curl_close($curl);

}else{
    $endpoint = "https://api.themoviedb.org/3/movie/popular";

    $curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5ZDBiNjJlZWVhNWYyMGJjNjg0ZjI3NTMzYTQ1MTU3OSIsIm5iZiI6MTc4OTM1Mjg2Mi43NTUsInN1YiI6IjZhYTc1YjllYmVmZjUwODkxYmE5ODcyYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.LKlg7RXermNdnsiZnWIMtWLHac-dLEMyJ8YB057HPpc',
        'Accept: Application/json'
    ]
]);

$response = curl_exec($curl);

$data = json_decode($response, true);

$result = $data["results"] ?? [];

curl_close($curl);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Film XI RPL</title>

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 30px;
        background-color: #f5f5f5;
    }

    form {
        width: 100%;
        max-width: 900px;
        margin: 0 auto 30px;
        display: flex;
        gap: 10px;
    }

    form input {
        flex: 1;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    form button {
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: white;
        cursor: pointer;
    }

    form button:hover {
        background-color: #555;
    }

    .film-container {
        max-width: 1100px;
        margin: auto;

        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .film-card {
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .film-card img {
        width: 100%;
        height: 360px;
        object-fit: cover;
        display: block;
    }

    .film-info {
        padding: 10px;
    }

    .film-info h3 {
        margin: 0 0 8px;
        font-size: 16px;
    }

    .film-info p {
        margin: 6px 0;
        font-size: 13px;
        line-height: 1.4;
    }

    .sinopsis {
        color: #555;
    }

    @media (max-width: 900px) {
        .film-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 650px) {
        .film-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 450px) {
        .film-container {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>
    <form action ="" method="get">
        <input type="text" name="search" placeholder="Cari Film...">
        <button type="submit">Cari</button>
    </form>

    <div class="film-container">
        <?php if (isset($result)): ?>
            <?php foreach($result as $results): ?>
                <div class="film-card">
                    <img src="https://image.tmdb.org/t/p/w500<?= $results["poster_path"] ?>" alt="">
                    <div class="film-info">
                        <h3><?= $results["title"]; ?></h3>
                        <p>Rating: <?= $results["vote_average"]; ?></p>
                        <p>Tanggal Rilis: <?= $results["release_date"]; ?></p>
                        <p class="sinopsis"><?= $results["overview"]; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
</body>
</html>