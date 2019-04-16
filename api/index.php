<?php


function rest()
{
    // header('Content-Type: application/json; charset=UTF-8');
    $url = $_SERVER['REQUEST_URI'];
    $urls = explode('/', $url);
    $result = '';
    if ($urls[1] === 'api') {

        if ($urls[2] === 'client') {

            if ($urls[3] === 'select') {

                if (count($urls) === 6) {
                    if ($urls[4] === 'telephone') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_telephone($urls[5]));
                    }
                    if ($urls[4] === 'card') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_card($urls[5]));
                    }
                }


                if (count($urls) === 4) {
                    header('HTTP/1.1 200 OK');
                    $result = json_encode(select_clients());

                }
            }
            if ($urls[3] === 'create') {
                header('HTTP/1.1 201 Created');
                create_client();

            }
            if ($urls[3] === 'update'
                && count($urls) === 5
                && is_numeric($urls[4]
                )) {
                header('HTTP/1.1 200 OK');
                update_client($urls[4]);
            }
            if ($urls[3] === 'delete'
                && count($urls) === 5
                && is_numeric($urls[4]
                )) {
                header('HTTP/1.1 200 OK');
                delete_client($urls[4]);
            }
            if (is_numeric($urls[3])) {
                if ($urls[4] === 'turnover') {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_turnover($urls[3]));
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        add_turnover($urls[3]);
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        delete_turnover($urls[3], $urls[6]);
                    }
                }
                if ($urls[4] === 'bonus') {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_bonus($urls[3]));
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        add_bonus($urls[3]);
                    }
                    if ($urls[5] === 'update'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        update_bonus($urls[3], $urls[6]);
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        delete_bonus($urls[3], $urls[6]);
                    }
                }
                if ($urls[4] === 'discount') {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_discount($urls[3]));
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        add_discount($urls[3]);
                    }
                    if ($urls[5] === 'update'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        update_discount($urls[3], $urls[6]);
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        delete_discount($urls[3], $urls[6]);
                    }
                }
            }

        }
        if ($urls[2] === 'turnover'
            && $urls[3] === 'select'
        ) {
            header('HTTP/1.1 200 OK');
            $result = json_encode(turnover_all());
        }
        if ($urls[2] === 'bonus'
            && $urls[3] === 'select'
        ) {
            header('HTTP/1.1 200 OK');
            $result = json_encode(bonus_all());
        }
        if ($urls[2] === 'discount'
            && $urls[3] === 'select'
        ) {
            header('HTTP/1.1 200 OK');
            $result = json_encode(discount_all());
        }

    }

    return $result;
}

function connection()
{
    return $mysqli = new mysqli('localhost', 'stud03', 'password', 'card');

}

function select_telephone($telephone)
{

    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM clients WHERE telephone = '$telephone' ORDER BY lastname LIMIT 1
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

function select_card($card)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM clients WHERE code = '$card' ORDER BY lastname LIMIT 1
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
    $mysqli = connection();
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

function create_client()
{
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $telephone = $_POST['telephone'];
    $birthday = $_POST['birthday'];
    $code = $_POST['code'];
    $bonus = $_POST['bonus'];
    $discount = $_POST['discount'];
    $mode = $_POST['mode'];
    $status = $_POST['status'];
    $edition = $_POST['edition'];
    $mysqli = connection();
    $sql = <<<SQL
        INSERT INTO clients (id,lastname,firstname,telephone,birthday,code,bonus,discount,mode,status,edition) VALUES 
        (null, '$lastname', '$firstname', '$telephone', '$birthday', '$code', '$bonus', '$discount', '$mode', '$status',
         '$edition')
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function update_client($id)
{
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $telephone = $_POST['telephone'];
    $birthday = $_POST['birthday'];
    $code = $_POST['code'];
    $bonus = $_POST['bonus'];
    $discount = $_POST['discount'];
    $mode = $_POST['mode'];
    $status = $_POST['status'];
    $edition = $_POST['edition'];
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE clients SET lastname = '$lastname', firstname ='$firstname', telephone = '$telephone',
        birthday = '$birthday', code = '$code', bonus = '$bonus', discount = '$discount', mode = '$mode',
        status  = '$status', edition = '$edition' WHERE id = $id
        
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function delete_client($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        DELETE FROM clients WHERE id = '$id'
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function select_turnover($client)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM turnover_card WHERE id_client = '$client' ORDER BY date_receipt
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

function add_turnover($client)
{
    $date = $_POST['date_receipt'];
    $amount = $_POST['amount'];
    $mysqli = connection();
    $sql = <<<SQL
        INSERT INTO turnover_card (id, date_receipt, amount, id_client) VALUES
        (null, '$date', '$amount', '$client' )
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function delete_turnover($client, $id)
{
    $mysqli = connection();
    $sql = <<<SQL
        DELETE FROM turnover_card WHERE id_client = '$client' AND id = '$id'
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function select_bonus($client)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM bonuses WHERE id_client = '$client' ORDER BY date_bonus
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

function add_bonus($client)
{
    $balance = $_POST['balance'];
    $status = $_POST['status'];
    $date = $_POST['date_bonus'];
    $mysqli = connection();
    $sql = <<<SQL
        INSERT INTO bonuses (id, balance, status, date_bonus, id_client) VALUES
        (null, '$balance', '$status', '$date', '$client' )
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function update_bonus($client, $id)
{
    $balance = $_POST['balance'];
    $status = $_POST['status'];
    $date = $_POST['date_bonus'];
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE bonuses SET balance = '$balance', status = '$status', date_bonus = '$date'  
        WHERE id = $id AND id_client = $client
        
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function delete_bonus($client, $id)
{
    $mysqli = connection();
    $sql = <<<SQL
        DELETE FROM bonuses WHERE id_client = '$client' AND id = '$id'
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function select_discount($client)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM discounts WHERE id_client = '$client' ORDER BY date_discount
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

function add_discount($client)
{
    $current = $_POST['current'];
    $new = $_POST['new'];
    $date = $_POST['date_discount'];
    $mysqli = connection();
    $sql = <<<SQL
        INSERT INTO discounts (id, current, new, date_discount, id_client) VALUES
        (null, '$current', '$new', '$date', '$client' )
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function update_discount($client, $id)
{
    $current = $_POST['current'];
    $new = $_POST['new'];
    $date = $_POST['date_discount'];
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE discounts SET current = '$current', new = '$new', date_discount = '$date'  
        WHERE id = $id AND id_client = $client
        
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function delete_discount($client, $id)
{
    $mysqli = connection();
    $sql = <<<SQL
        DELETE FROM discounts WHERE id_client = '$client' AND id = '$id'
SQL;
    try {
        if (!$mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }

    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return true;
}

function turnover_all()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM turnover_card ORDER BY date_receipt
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

function bonus_all()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM bonuses ORDER BY date_bonus
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
function discount_all()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM discounts ORDER BY date_discount
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

echo rest();