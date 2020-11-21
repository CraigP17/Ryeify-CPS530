<?php 

    $config = [

            'dsn' => 'mysql:host=______;dbname=______;',
            'user' => 'root',
            'password' => '_______'
        
    ];
    $db_name = $config['dsn'] ?? '';
    $user = $config['user'] ?? '';
    $password = $config['password'] ?? '';

    $conn = new PDO($db_name, $user, $password);
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Throws an exception when error occurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare("SHOW TABLES;");
    $query->execute();
    $data = $query->fetchAll();
    
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    
    $conn = null;
    exit;

?>
