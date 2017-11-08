<?php
session_start();
    
function displayCart() {
    include 'dbConnections.php';
    $conn = getDatabaseConnection();
    $array = $_SESSION['vgID'];
    
    echo "<div id = 'tables'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Game</th>";
    echo "<th>Price</th>";
    echo "</tr>";
    
    if (empty($array)){
        echo "<tr>";
        echo "<td> (empty) </td>";
        echo "<td> (empty) </td>";
        echo "</tr>";
    }
          
    foreach($array as $a){
        $sql = "SELECT * FROM gp2_game WHERE vgID = $a";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<tr>";
        echo "<td>".ucwords($records['name'])."</td>";
        echo "<td>".ucwords($records['price'])."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Shopping Cart </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
          <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
      
       <div id = 'wrapper'>
         <div id = 'luigi'>  
            
            
            <a href="https://fontmeme.com/new-super-mario-bros-wii-font/"><img src="https://fontmeme.com/permalink/171108/374b98e378c31fd172deb648b5888210.png" alt="new-super-mario-bros-wii-font" border="0"></a>
      </div>
      
       <br></br>
        <?=displayCart()?>
        
        
        
        
       <div id = "back"> 
        <form action ='clear.php'>
            <input type='submit' class = 'button' value = 'Clear'>
       </form>
       
       
       <br></br>
        <form action='back.php'>
                <input type='submit' class = 'button' value='Back'>
        </form>
        </div>
        
        
        </div>
        
    </body>
</html>