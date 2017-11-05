<?php
session_start();


function displayGameInfo() {
    
    include 'dbConnections.php';
    $conn = getDatabaseConnection();

    $sql = "SELECT * FROM gp2_game a JOIN gp2_published b ON a.vgID = b.vgID WHERE a.vgID = :vgId";
    
    $namedParam = array(":vgId"=>$_GET['vgID']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        echo "Name: ". $record['name'] ."<br/>Year: ".  $record['year'] . "<br/>Console: " . $record['console'] . "<br/>MetaCritic Score: " . $record['metacritic'] . "<br/>Publisher: " . $record['publisher']. "<br/>";
    }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Game Information </title>
    </head>
    <body>
        <h2> Game Information </h2>
        <?=displayGameInfo()?>
    </body>
</html>