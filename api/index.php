<?php
function api()
{
    header('Content-Type: application/json; charset=UTF-8');
    $url = $_SERVER['REQUEST_URI'];
    $urls = explode('/', $url);
    $result = false;
    $check = false;
    if ($urls[1] === 'api') {
        if ($urls[2] === 'mode'
            && count($urls) === 3) {
            header('HTTP/1.1 200 OK');
            if (add_mode()) {
                $result = mode();
                $check = true;
            }
        }
        if ($urls[2] === 'login'
            && count($urls) === 3) {
            $function = login();
            if ($function !== false) {
                header('HTTP/1.1 200 OK');
                $result = name_user();
                $check = true;
                if ($function === false) {
                    header('HTTP/1.0 401 Unauthorized');
                }
            }
        }
        if ($urls[2] === 'user'
            && login() === 'manager'
        ) {
            header('HTTP/1.1 200 OK');
            if ($urls[3] === 'select') {
                if (count($urls) === 4) {
                    header('HTTP/1.1 200 OK');
                    $result = json_encode(select_users());
                    $check = true;
                }
                if (count($urls) === 5
                    && is_numeric($urls[4])) {
                    header('HTTP/1.1 200 OK');
                    $result = json_encode(select_user($urls[4]));
                    $check = true;
                }
            }
            if ($urls[3] === 'create') {
                header('HTTP/1.1 200 OK');
                $result = create_user();
                $check = true;
            }
            if ($urls[3] === 'update'
                && is_numeric($urls[4])
            ) {
                header('HTTP/1.1 200 OK');
                $result = update_user($urls[4]);
                $check = true;
            }
            if ($urls[3] === 'delete'
                && is_numeric($urls[4])
            ) {
                header('HTTP/1.1 200 OK');
                $result = delete_user($urls[4]);
                $check = true;
            }
        }
        if ($urls[2] === 'client'
            && login() !== false
        ) {
            if ($urls[3] === 'select') {
                if (count($urls) === 6) {
                    if ($urls[4] === 'telephone') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_telephone($urls[5]));
                        $check = true;
                    }
                    if ($urls[4] === 'card') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_card($urls[5]));
                        $check = true;
                    }
                }
                if (count($urls) === 4
                    && login() === 'manager'
                ) {
                    header('HTTP/1.1 200 OK');
                    $result = json_encode(select_clients());
                    $check = true;
                }
            }
            if ($urls[3] === 'select-by-days'
                && login() === 'manager'
            ) {
                header('HTTP/1.1 200 OK');
                $result = json_encode(select_clients_days());
                $check = true;
                if ($result === false) {
                    header('HTTP/1.1 400 Bad Request');
                }
            }
            if ($urls[3] === 'select-active'
                && login() === 'manager'
            ) {
                header('HTTP/1.1 200 OK');
                $result = json_encode(select_active_clients());
                $check = true;
            }
            if ($urls[3] === 'create') {
                header('HTTP/1.1 200 OK');
                $result = create_client();
                $check = true;
            }
            if ($urls[3] === 'update'
                && count($urls) === 5
                && is_numeric($urls[4]
                )) {
                header('HTTP/1.1 200 OK');
                $result = update_client($urls[4]);
                $check = true;
            }
            if ($urls[3] === 'delete'
                && count($urls) === 5
                && is_numeric($urls[4]
                )) {
                header('HTTP/1.1 200 OK');
                $result = delete_client($urls[4]);
                $check = true;
            }
            if (is_numeric($urls[3])) {
                if ($urls[4] === 'turnover') {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_turnover($urls[3]));
                        $check = true;
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        $result = add_turnover($urls[3]);
                        $check = true;
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        $result = delete_turnover($urls[3], $urls[6]);
                        $check = true;
                    }
                }
                if ($urls[4] === 'bonus'
                    && mode() === 'bonus'
                ) {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_bonus($urls[3]));
                        $check = true;
                    }
                    if ($urls[5] === 'select-by-days') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_bonus_days($urls[3]));
                        $check = true;
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        $result = add_bonus($urls[3], 0);
                        $check = true;
                    }
                    if ($urls[5] === 'update'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        $result = update_bonus($urls[3], $urls[6]);
                        $check = true;
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        $result = delete_bonus($urls[3], $urls[6]);
                        $check = true;
                    }
                    if ($urls[5] === 'remove') {
                        header('HTTP/1.1 200 OK');
                        $result = remove_bonus($urls[3]);
                        $check = true;
                    }
                }
                if ($urls[4] === 'discount'
                    && mode() === 'discount'
                ) {
                    if ($urls[5] === 'select') {
                        header('HTTP/1.1 200 OK');
                        $result = json_encode(select_discount($urls[3]));
                        $check = true;
                    }
                    if ($urls[5] === 'add') {
                        header('HTTP/1.1 200 OK');
                        $result = add_discount($urls[3]);
                        $check = true;
                    }
                    if ($urls[5] === 'update'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        $result = update_discount($urls[3], $urls[6]);
                        $check = true;
                    }
                    if ($urls[5] === 'delete'
                        && count($urls) === 7
                        && is_numeric($urls[6]
                        )) {
                        header('HTTP/1.1 200 OK');
                        $result = delete_discount($urls[3], $urls[6]);
                        $check = true;
                    }
                }
                if ($urls[4] === 'block-card') {
                    header('HTTP/1.1 200 OK');
                    $result = block_card($urls[3]);
                    $check = true;
                }
                if ($urls[4] === 'delete-card') {
                    header('HTTP/1.1 200 OK');
                    $result = delete_card($urls[3]);
                    $check = true;
                }
            }
        }
        if ($urls[2] === 'turnover'
            && login() === 'manager'
        ) {
            if ($urls[3] === 'select') {
                header('HTTP/1.1 200 OK');
                $result = json_encode(turnover_all());
                $check = true;
            }
            if ($urls[3] === 'select-with-card') {
                header('HTTP/1.1 200 OK');
                $result = json_encode(turnover_all_card());
                $check = true;
            }
        }
        if ($urls[2] === 'bonus'
            && $urls[3] === 'select'
            && login() === 'manager'
            && mode() === 'bonus'
        ) {
            header('HTTP/1.1 200 OK');
            $result = json_encode(bonus_all());
            $check = true;
        }
        if ($urls[2] === 'discount'
            && $urls[3] === 'select'
            && login() === 'manager'
            && mode() === 'discount'
        ) {
            header('HTTP/1.1 200 OK');
            $result = json_encode(discount_all());
            $check = true;
        }
        if ($check === false) {
            header('HTTP/1.1 400 Bad Request');
        }
    }
    return $result;
}

/**
 * Метод реализует авторизацию пользователя, возвращает его должность
 *
 * @return mixed
 */
function login()
{
    $function = false;
    $user = $_SERVER['PHP_AUTH_USER'];
    $worker = select_user_key($user);
    if (!empty($worker)) {
        $function = $worker['function'];
    }
    return $function;
}

/**
 * Метод возвращает имя авторизированного пользователя
 *
 * @return mixed
 */
function name_user()
{
    $name = false;
    $user = $_SERVER['PHP_AUTH_USER'];
    $worker = select_user_key($user);
    if (!empty($worker)) {
        $name = $worker['name'];
    }
    return $name;
}

/**
 * Метод назначает вид карт, используемых в сервисе
 *
 * @return bool
 */
function add_mode()
{
    $mode = $_POST['mode_card'];
    $check = false;
    if ($mode === 'bonus' || $mode === 'discount') {
        $check = true;
        $mysqli = connection();
        $sql = <<<SQL
       UPDATE mode_cards SET mode_card = '$mode' WHERE id = '1'
      
SQL;
        try {
            if (!$mysqli->query($sql)) {
                throw new Exception($mysqli->error);
            }
        } catch (Exception $e) {
            echo 'Error: ', $e->getMessage(), "\n";
        }
    }
    return $check;
}

/**
 * Метод вынимает из базы данных вид карт
 *
 * @return array|null
 */
function select_mode()
{
    $mysqli = connection();
    $sql = <<<SQL
       SELECT * FROM mode_cards WHERE id = '1' LIMIT 1
      
SQL;
    try {
        if (!$res = $mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }
    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return $res->fetch_assoc();
}

/**
 * Метод возвращает вид карт, используемых в сервисе
 *
 * @return mixed
 */
function mode()
{
    $mode_card = select_mode();
    $result = $mode_card['mode_card'];
    return $result;
}
function connection()
{
    return  $mysqli = new mysqli('localhost', 'user', 'Anarasumanara1812-', 'card');
}

/**
 * Метод возвращает список пользователей
 *
 * @return mixed
 */
function select_users()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM users ORDER BY name
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

/**
 * Метод возвращает пользователя по его ключу
 *
 * @param $key
 *
 * @return array|null
 */
function select_user_key($key)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM users WHERE api_key = '$key' ORDER BY name LIMIT 1
SQL;
    try {
        if (!$res = $mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }
    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return $res->fetch_assoc();
}

/**
 * Метод возвращает пользователя по его идентификатору
 *
 * @param $id
 *
 * @return mixed
 */
function select_user($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM users WHERE id = '$id' ORDER BY name LIMIT 1
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

/**
 * Метод, создающий нового пользователя
 *
 * @return bool
 */
function create_user()
{
    $name = $_POST['name_user'];
    $key = hash('tiger192,3', $name);
    $worker = $_POST['function'];
    $check = false;
    if ($worker === 'operator' || $worker === 'manager') {
        $check = true;
        $mysqli = connection();
        $sql = <<<SQL
        INSERT INTO users (id, api_key, name, function) VALUES 
        (null, '$key', '$name', '$worker' )
SQL;
        try {
            if (!$mysqli->query($sql)) {
                throw new Exception($mysqli->error);
            }
        } catch (Exception $e) {
            echo 'Error: ', $e->getMessage(), "\n";
        }
    }
    return $check;
}

/**
 * Метод, изменяющий данные пользователя
 *
 * @param $id
 *
 * @return bool
 */
function update_user($id)
{
    $key = $_POST['api_key'];
    $name = $_POST['name_user'];
    $worker = $_POST['function'];
    $check = false;
    if ($worker === 'operator' || $worker === 'manager') {
        $check = true;
        $mysqli = connection();
        $sql = <<<SQL
        UPDATE users SET api_key = '$key', name = '$name', function = '$worker' WHERE id = $id
        
SQL;
        try {
            if (!$mysqli->query($sql)) {
                throw new Exception($mysqli->error);
            }
        } catch (Exception $e) {
            echo 'Error: ', $e->getMessage(), "\n";
        }
    }
    return $check;
}

/**
 * Метод, удаляющий пользователя
 *
 * @param $id
 *
 * @return bool
 */
function delete_user($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        DELETE FROM users WHERE id = '$id'
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

/**
 * Метод, выбирающий клиента по его номеру телефона
 *
 * @param $telephone
 *
 * @return mixed
 */
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

/**
 * Метод, выбирающий клиента по его идентификатору
 *
 * @param $id
 *
 * @return array|null
 */
function select_client($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM clients WHERE id = '$id' ORDER BY lastname LIMIT 1
SQL;
    try {
        if (!$res = $mysqli->query($sql)) {
            throw new Exception($mysqli->error);
        }
    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
    return $res->fetch_assoc();
}

/**
 * Метод, возвращающий польователя по номеру его карты
 *
 * @param $card
 *
 * @return mixed
 */
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

/**
 * Метод возвращающий список клиентов сервиса
 *
 * @return mixed
 */
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

/**
 * Метод, возвращающий список клиентов с активными картами
 *
 * @return mixed
 */
function select_active_clients()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM clients WHERE status = 'active' ORDER BY lastname
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

/**
 * Метод, возвращающий список клинетов зарегистрированных в определенный срок
 *
 * @return mixed
 */
function select_clients_days()
{
    $firstday = $_POST['firstday'];
    $lastday = $_POST['lastday'];
    $res = false;
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM clients WHERE  DATE_FORMAT(edition,'%Y-%m-%d') BETWEEN '$firstday' AND '$lastday' ORDER BY lastname
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

/**
 * Метод, создающий нового клиента
 *
 * @return bool
 */
function create_client()
{
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $telephone = $_POST['telephone'];
    $birthday = $_POST['birthday'];
    $code = $_POST['code'];
    $bonus = $_POST['bonus'];
    $discount = $_POST['discount'];
    $mode = mode();
    $status = 'active';
    $edition = date('Y-m-d');
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

/**
 * Метод, изменяющий данные клиента
 *
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, удаляющий клиента из базы данных
 *
 * @param $id
 *
 * @return bool
 */
function delete_client($id)
{
    $mysqli = connection();
    delete_bonuses($id);
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

/**
 * Метод, удаляющий все бонусы клиента из базы данных
 *
 * @param $id
 *
 * @return bool
 */
function delete_bonuses($id)
{
    $mysqli = connection();

    $sql = <<<SQL
        DELETE FROM bonuses WHERE id_client = '$id'
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
/**
 * Метод меняет статус карты на заблокированный
 *
 * @param $id
 *
 * @return bool
 */
function block_card($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE clients SET status = 'blocked' WHERE id = $id
        
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

/**
 * Метод меняет статус карты на удаленный
 *
 * @param $id
 *
 * @return bool
 */
function delete_card($id)
{
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE clients SET status = 'deleted' WHERE id = $id
        
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

/**
 * Метод, возвращающий список покупок клиента по его идентификатору
 *
 * @param $client
 *
 * @return mixed
 */
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

/**
 * Метод, добавляющий новую покупку в базу данных
 *
 * @param $client
 *
 * @return bool
 */
function add_turnover($client)
{
    $date = date('Y-m-d H:i:s');
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

/**
 * Метод, удаляющий покупку из базы данных
 *
 * @param $client
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, возвращающий список начисленных и списанных бонусов клиента
 *
 * @param $client
 *
 * @return mixed
 */
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

/**
 * Метод, возращающий список бонусов за определенный срок
 *
 * @param $client
 *
 * @return mixed
 */
function select_bonus_days($client)
{
    $firstday = $_POST['firstday'];
    $lastday = $_POST['lastday'];
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM bonuses WHERE DATE_FORMAT(date_bonus,'%Y-%m-%d') BETWEEN '$firstday' AND '$lastday' 
        AND id_client = '$client'  ORDER BY date_bonus
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

/**
 * Метод добавляет бонусы на карту клиента
 *
 * @param $client
 * @param $bonus
 *
 * @return bool
 */
function add_bonus($client, $bonus)
{
    $receipt = $_POST['amount'];
    $border = $_POST['border'];
    $balance = $_POST['balance'];
    $status = 'active';
    $date = date('Y-m-d H:i:s');
    $result = false;
    $mysqli = connection();
    if (birthday($client, $date) || holiday($date)) {
        $balance *= 2;
    }
    if ($bonus > 0) {
        $balance = $bonus;
    }
    if ($receipt >= $border || $bonus > 0) {
        change_bonus_card($client, $balance);
        $result = true;
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
    }
    return $result;
}

/**
 * Метод, вычисляющий является ли день зачисления бонуса днем рождения
 *
 * @param $id
 * @param $dateBonus
 *
 * @return bool
 */
function birthday($id, $dateBonus)
{
    $result = false;
    $client = select_client($id);
    $birthday = $client['birthday'];
    $birthday = explode('-', $birthday);
    $birthday = $birthday[1] . '-' . $birthday[2];
    $date = stristr($dateBonus, ' ', true);
    $date = explode('-', $date);
    $date = $date[1] . '-' . $date[2];
    if ($birthday === $date) {
        $result = true;
    }
    return $result;
}

/**
 * Метод, вычисляющий является ли дата зачисления бонуса праздником
 *
 * @param $dateBonus
 *
 * @return bool
 */
function holiday($dateBonus)
{
    $result = false;
    $date = stristr($dateBonus, ' ', true);
    $date = explode('-', $date);
    $date = $date[1] . '-' . $date[2];
    if (!empty(select_holiday($date))) {
        $result = true;
    }
    return $result;
}

/**
 * Метод, изменяющий данные зачисления бонуса
 *
 * @param $client
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, удаляющий бонус из базы данных
 *
 * @param $client
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, возвращающий список изменений скидок клиента
 *
 * @param $client
 *
 * @return mixed
 */
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

/**
 * Метод добавляющий смену скидки клиента
 *
 * @param $client
 *
 * @return bool
 */
function add_discount($client)
{
    $current = $_POST['current'];
    $new = $_POST['new'];
    $date = date('Y-m-d H:i:s');
    $mysqli = connection();
    change_discount_card($client, $new);
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

/**
 * Метод, изменяющий данные смены скидки клиента
 *
 * @param $client
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, удаляющий смену скидки клиента из базы данных
 *
 * @param $client
 * @param $id
 *
 * @return bool
 */
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

/**
 * Метод, возвращающий весь оборот покупок сервиса
 *
 * @return mixed
 */
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

/**
 * Метод, возвращающий весь оборот покупок с использованием карт
 *
 * @return mixed
 */
function turnover_all_card()
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM turnover_card WHERE NOT id_client = 0 ORDER BY date_receipt
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

/**
 * Метод возвращающий список всех бонусов
 *
 * @return mixed
 */
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

/**
 * Метод, возвращающий все смены скидок
 *
 * @return mixed
 */
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

/**
 * Метод, проверяющий наличие даты в таблице праздников
 *
 * @param $date
 *
 * @return mixed
 */
function select_holiday($date)
{
    $mysqli = connection();
    $sql = <<<SQL
        SELECT * FROM holidays WHERE  day = '$date'  ORDER BY day LIMIT 1
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

/**
 * Метод, меняющий значение бонусов на карте
 *
 * @param $id
 * @param $balance
 *
 * @return bool
 */
function change_bonus_card($id, $balance)
{
    $client = select_client($id);
    $bonus = $client['bonus'];
    $bonus += $balance;
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE clients SET bonus = $bonus WHERE id = $id
        
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

/**
 *
 * Метод, меняющий значение скидки на карте
 * @param $id
 * @param $new
 *
 * @return bool
 */
function change_discount_card($id, $new)
{
    $mysqli = connection();
    $sql = <<<SQL
        UPDATE clients SET discount = $new WHERE id = $id
        
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

/**
 * Метод снимающий бонусы с карты
 *
 * @param $id
 *
 * @return bool
 */
function remove_bonus($id)
{
    $result = false;
    $client = select_client($id);
    $bonus = $client['bonus'];
    $remove = $_POST['remove_bonus'];
    $mysqli = connection();
    if ($bonus >= $remove && $remove !== 0) {
        $result = true;
        $bonus -= $remove;
        $sql1 = <<<SQL
        UPDATE clients SET bonus = $bonus WHERE id = $id
        
SQL;
        $sql2 = <<<SQL
        UPDATE bonuses SET status = 'deleted' WHERE id_client = $id
        
SQL;
        try {
            if (!$mysqli->query($sql2)) {
                throw new Exception($mysqli->error);
            }
            if ($bonus > 0) {
                add_bonus($id, $bonus);
            }
            if (!$mysqli->query($sql1)) {
                throw new Exception($mysqli->error);
            }
        } catch (Exception $e) {
            echo 'Error: ', $e->getMessage(), "\n";
        }
    }
    return $result;
}
echo api();