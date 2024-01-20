<?php

$usersFile = "user.txt";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $key = $_GET['key'];

    $userFileContent = file_get_contents($usersFile);
    $userArray = explode(PHP_EOL, $userFileContent);

    $foundKey = false;
    foreach ($userArray as $userDataJson) {
        if (!empty($userDataJson)) {
            $userData = json_decode($userDataJson, true);
            if ($userData['key'] === $key) {
                $foundKey = true;
                $expiration_time = strtotime($userData['expiration_time']);
                $current_time = time();

                if ($current_time < $expiration_time) {
                    $response = array(
                        "Status" => "success",
                        "key" => $key,
                        "Time" => date('Y-m-d H:i:s', $expiration_time),
                        "Buy Key" => "Telegram: citynightverry"
                    );
                } else {
                    $response = array(
                        "Status" => "error",
                        "reason" => "Key: $key has expired or does not exist. Please purchase a new key",
                        "Buy Key" => "Telegram: citynightverry"
                    );
                }
                break;
            }
        }
    }

    if (!$foundKey) {
        $response = array(
            "Status" => "error",
            "reason" => "Key: $key has expired or does not exist. Please purchase a new key",
            "Buy Key" => "Telegram: citynightverry"
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
