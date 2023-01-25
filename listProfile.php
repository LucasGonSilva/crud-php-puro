<?php

include 'connection.php';

$query_profiles = "SELECT * 
                FROM profiles
                ORDER BY id DESC";
$result_profiles = $conn->prepare($query_profiles);
$result_profiles->execute();

$dados = "";

$dados .= "<option value='' selected>Selecione</option>";
while ($row_profile = $result_profiles->fetch(PDO::FETCH_ASSOC)) {
    extract($row_profile);
    $dados .= "<option value='$id'>$name</option>";
}

echo $dados;
