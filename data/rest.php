<?php

// Populate using rest CALL

// $service_url = 'http://'.getenv('SERVICE').':8080/rest_items.json';
$service_url = getenv('SERVICE');

$curl = curl_init($service_url);                                                                                                                           
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($curl);
if ($response === false) {
    $info = curl_getinfo($curl); 
    curl_close($curl);
    $_SESSION['message'] = "error occured during curl exec. Additional info: ". var_export($info);
    header('Location: /error.php');
    die();
}
curl_close($curl);

$response = json_decode($response, true);

$_SESSION['item'] = array();

// Find theme
$selector = $_SESSION['SELECTOR'];
$i = 0;

foreach ($response as $item) {

    $id = $item['id'];
    $name = $item['name'];
    $theme = $item['theme'];
    $caption = $item['caption'];
    $rank = $item['rank'];
    $trivia = $item['trivia'];
    $filename = $item['filename'];

    // Filter by theme
    if ( $selector == $theme ) {
        $_SESSION['item'][$i] = array(
            'name' => $name,
            'theme' => $theme,      
            'rank' => $rank,
            'caption' => $caption,
            'trivia' => $trivia, 
            'filename' => $filename,
            'prev' => $name,
            'next' => $name,
            'rating' => 0
        );
        $i = $i+1;
    }
}

?>
