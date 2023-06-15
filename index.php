<?php
// CREATED BY AKASH VISHWAKARMA
// Set the API endpoint URL
$api_url = 'https://api.nasa.gov/planetary/apod';

// Set the API key
$api_key = 'YOUR_API_KEY';


// Set the number of images to retrieve
$num_images = 10;

// Build the API request URLs
$request_urls = array();
for ($i = 0; $i < $num_images; $i++) {
    $date = date('Y-m-d', strtotime('-' . $i . ' day'));
    $request_urls[] = $api_url . '?api_key=' . $api_key . '&date=' . $date;
}

// Make the API requests
$responses = array();
foreach ($request_urls as $url) {
    $responses[] = file_get_contents($url);
}

// Parse the JSON responses into arrays
$data = array();
foreach ($responses as $response) {
    $data[] = json_decode($response, true);
}

// Start HTML output
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Astronomy Picture of the Day</title>';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>';
echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
echo '</head>';
echo '<body>';

// Display the APOD images and information
echo '<div class="container">';
echo '<h1 class="text-center">Astronomy Picture of the Day</h1>';
foreach ($data as $item) {
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo '<img src="' . $item['url'] . '" alt="' . $item['title'] . '" class="img-fluid rounded">';
    echo '</div>';
    echo '<div class="col-md-6">';
    echo '<h2>' . $item['title'] . '</h2>';
    echo '<p><strong>Date:</strong> ' . $item['date'] . '</p>';
    echo '<p>' . $item['explanation'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '<hr>';
}
echo '</div>';

// End HTML output
echo '</body>';
echo '</html>';

?>
