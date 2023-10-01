<?php 

    $image = $_FILES["file"]["tmp_name"];
    $url = 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1';

    echo $image;

    $data = array(
        'file' => $image
    );

    $headers = [ 
        'Authorization: Bearer x2skj57v2poPW8UxIQGqBACBxkJ4Glg42lVhbDPe',
        'Content-Type: application/json'
    ];
    

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    print_r($response);