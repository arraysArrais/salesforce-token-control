<?php



function isTokenValid($arg){

    $dateInserted = new DateTime();
    $dateInserted->setTimestamp($arg['date_inserted']);

    $now = new DateTime();

    $dif = $dateInserted->diff($now);

    //We consider a token valid when it is issued within one hour, tops
    //You can change this value to work with any kind of time that suits your need by using $dif DateInterval properties
    return ($dif->h >= 1) ? false : true;
}
