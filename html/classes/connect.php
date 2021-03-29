  <?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=public404', 'groot', 'Beta2^31-1');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
//$conn = new PDO('mysql:host=public404.db.8949141.hostedresource.com;dbname=public404', 'public404', 'Aei!tp230wn');
?>
