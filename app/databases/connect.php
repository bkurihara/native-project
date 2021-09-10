  
<?php

function myConnect()
{
    $host = 'localhost';
    $db   = 'native-php';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function addUser()
{
    $pdo = myConnect();

    $data = [
        'name' => $_POST['name'],
        'name_kana' => $_POST['name_kana'],
        'gender' => $_POST['gender'],
        'email' => $_POST['email'],
        'postal_code1' => $_POST['postal_code1'],
        'postal_code2' => $_POST['postal_code2'],
        'address1' => $_POST['address1'],
        'address2' => $_POST['address2'],
        'address3' => $_POST['address3'],
        'phone' => $_POST['phone'],
    ];

    $sql = "INSERT INTO users (name, name_kana, gender, email, postal_code1," .
        " postal_code2, address1, address2, address3, phone) VALUES (:name, :name_kana, :gender," .
        ":email, :postal_code1, :postal_code2, :address1, :address2, :address3, :phone)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

addUser();
// <!-- EVERYTHING MADE BY JONAS PAQUIBOT -->
?>

