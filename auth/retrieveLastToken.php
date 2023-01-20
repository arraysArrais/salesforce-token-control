<?php

function retrieveLastToken($db){
    $sql = $db->prepare("SELECT token, date_inserted FROM auth WHERE id = (SELECT MAX(id) FROM auth)");
    $sql->execute();
    $LastTokenInserted = $sql->fetch(PDO::FETCH_ASSOC);
    return $LastTokenInserted;
}
