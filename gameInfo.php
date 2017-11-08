<?php
session_start();


function displayGameInfo() {
    
    include 'dbConnections.php';
    $conn = getDatabaseConnection();

    $sql = "SELECT * 
            FROM gp2_game g 
            JOIN gp2_published p 
            ON g.vgID = p.vgID 
            JOIN gp2_developer d 
            ON p.sID = d.dID
            WHERE g.vgID = :vgId";
            
    
    $namedParam = array(":vgId"=>$_GET['vgID']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Displays game informations
    foreach ($records as $record) {
        echo "Name: ". ucwords($record['name']) .
        "<br/>Price: ". $record['price'].
        "<br/>Year: ".  $record['year'] . 
        "<br/>Console: " . ucwords($record['console']) . 
        "<br/>MetaCritic Score: " . $record['metacritic'] . 
        "<br/>Publisher: " . ucwords($record['publisher']). 
        "<br/>Developer: " . ucwords($record['developer']) . "<br/>";
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
        <form action='index.php'>
                <input type='submit' value='Back'>
        </form>
    </body>
</html>