<?php

require_once('./vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "381801650-NlkemT2ZwfWIIzyGk0UdmqP2Obfsgv9BJLtXhgyg",
    'oauth_access_token_secret' => "a9GRbKCd5msSIxD7CRWDdMzJlAfTtYmxtkeonFpWD0rqB",
    'consumer_key' => "YiqqQzxLPOv4P9NazbBCAaiuZ",
    'consumer_secret' => "LPMEJaAuGKq9zrY9kKkBWWEUji5CaDKCv8cVARe8UIWutwSkrD"
);


$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#hf2016 @hackferencebrum filter:media';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$tweets = json_decode($twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest(), $assoc = TRUE);


$statuses = $tweets['statuses'];

$images = [];



// echo var_dump($statuses);
foreach ($statuses as $status) {
   $entities = $status['entities'];
   if (array_key_exists('media', $entities)) {
    $media = $entities['media'];
        foreach ($media as $image) {

            if ($image['type'] == 'photo') {
                $images[] = $image['media_url'];
            }
        }
   }

}


echo var_dump($images);
