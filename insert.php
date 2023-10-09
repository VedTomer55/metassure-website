<?php
try {
    $host = 'verismart-dev-mysql-server.mysql.database.azure.com';
    $dbName = 'company_website';
    $userName = 'mysql_admin';
    $password = 'MBrFxPnTMqS!4';

    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Email address to insert
    $email = 'example@example.com';

    // Get the current timestamp
    $currentTimestamp = date("Y-m-d H:i:s");

    // Static website value
    $website = 'metassure.com';

    // Prepare and execute the SQL INSERT statement
    $sql = "INSERT INTO subscriber_list (email, created_at, website) VALUES (:email, :created_at, :website)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':created_at', $currentTimestamp);
    $stmt->bindParam(':website', $website);
    $stmt->execute();

    echo "Email address with timestamp and website inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
