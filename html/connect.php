  <?php  

try {
    $conn = new PDO('mysql:host=public404.db.8949141.hostedresource.com;dbname=public404', 'public404', 'Aei!tp230wn');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>