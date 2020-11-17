<?php

// get user from db and verify
function get_user($user, $parola)
{
    global $link;

    $user = mysqli_real_escape_string($link, $user);
    $parola = mysqli_real_escape_string($link, $parola);

    $result = mysqli_query($link, "SELECT * FROM doctori WHERE user = '$user' AND parola = '$parola' LIMIT 1");

    return mysqli_fetch_assoc($result);
}

function query_db($link, $sql, $location){
    $result = mysqli_query($link, $sql);
    if(isset($result)){
        header("location: $location");
    }
}

function delete_db($link, $sql){
    $result = mysqli_query($link, $sql);
}

// function no_records($result){
//     if(mysqli_num_rows($result) == 0){
//         echo $message = "<td>Nu exista date.</td>";
//     }
// }
?>