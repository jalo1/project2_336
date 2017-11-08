<?php
session_start();


function displayGameInfo() {
    
    include 'dbConnections.php';
    $conn = getDatabaseConnection();

    $sql = "SELECT * 
            FROM gp2_game a 
            JOIN gp2_published b 
            ON a.vgID = b.vgID 
            WHERE a.vgID = :vgId";
    
    $namedParam = array(":vgId"=>$_GET['vgID']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
   return $records;
   
   /* 
    foreach ($records as $record) {
        echo "Name: ". $record['name'] .
        "<br/>Price: ". $record['price'].
        "<br/>Year: ".  $record['year'] . 
        "<br/>Console: " . $record['console'] . 
        "<br/>MetaCritic Score: " . $record['metacritic'] . 
        "<br/>Publisher: " . $record['publisher']. "<br/>";
    }
    */
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Game Information </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h2> Game Information </h2>
         <?php
        $games = displayGameInfo();
         foreach($games as $g) {
        echo "<div id = 'table'>";
        echo "<table>";
        echo "<tr>
                <th>Name </th>";
        echo "<td>".ucwords($g['name'])."</td>"; 
        echo "</tr>";
        echo "<tr>
                <th>Price: </th>";
        echo "<td>".ucwords($g['price'])."</td>"; 
         echo "<tr>
                <th>Year: </th>";
        echo "<td>".ucwords($g['year'])."</td>";
          echo "<tr>
                <th>Console: </th>";
        echo "<td>".ucwords($g['console'])."</td>"; 
          echo "<tr>
                <th>Metacritic Score: </th>";
        echo "<td>".ucwords($g['metacritic'])."</td>"; 
         echo "<tr>
                <th>Publisher: </th>";
        echo "<td>".ucwords($g['publisher'])."</td>"; 
      
        }
        
        echo "</table>";
        echo "</div>";
        ?>
        
        
        <form action='index.php'>
                <input type='submit' value='Back'>
        </form>
    </body>
</html>