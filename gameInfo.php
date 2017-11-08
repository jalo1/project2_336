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

   
   return $records;
   
 
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
    <div id = 'wrapper'>  
    <div id = 'wario'>
<a href="https://fontmeme.com/new-super-mario-bros-wii-font/"><img src="https://fontmeme.com/permalink/171108/341f4fc0740c7b6afe8a02e2eb569c70.png" alt="new-super-mario-bros-wii-font" border="0"></a>
   </div>
   <br></br>
    <div id = "table">
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
        </div>
        
      </br>
        <div id = "back">
        <form action='back.php'>

                <input type='submit' class = 'button' value='Back'>
        </form>
        </div>
        
        </div>
    </body>
</html>