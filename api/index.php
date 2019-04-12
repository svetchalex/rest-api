<?php


function rest()
{
    $url = $_SERVER['REQUEST_URI'];
    $urls = explode('/', $url);
    var_dump($urls);
    if ($urls[1] === 'api') {

        if ($urls[2] === 'client') {

            if ($urls[3] === 'select') {

                if (count($urls) === 5) {

                    $client= select_client($urls[4]);
                  echo  json_encode($client);

                }
                if (count($urls) === 4) {
                    $clients = select_clients();
                    echo  json_encode($clients);

                } else {
                    header('HTTP/1.1 400 Bad Request');
                }
            }

        }
    }
}


function select_client($id)
{
    $mysqli = new mysqli('localhost', 'stud03', 'password', 'card');
    $sql = <<<SQL
        SELECT * FROM clients WHERE id = $id ORDER BY lastname LIMIT 1
SQL;
    try {
        if (!$res = $mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return $res->fetch_all();
}
function select_clients()
{
    $mysqli = new mysqli('localhost', 'stud03', 'password', 'card');
    $sql = <<<SQL
        SELECT * FROM clients ORDER BY lastname
SQL;
    try {
        if (!$res = $mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return $res->fetch_all();
}

rest();