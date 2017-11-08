<?php
session_start();
    if (!isset($_SESSION['vgID']) && empty($_SESSION['vgID'])) {
        $_SESSION['vgID'] = array();
        $_SESSION['sortBy']="";
        $_SESSION['filter']="";
        $_SESSIOn['submit']="";
    }

    include 'dbConnections.php';
    $conn = getDatabaseConnection();
    
    
    
    function displayGames() {
        global $conn;
        $sql = "SELECT * FROM gp2_game game
                JOIN gp2_published pub
                ON pub.vgID=game.vgID
                JOIN gp2_developer dev 
                ON pub.sID = dev.dID";

        if (isset($_GET['submit'])){
            
            $_SESSION['submit']="submit=Search";
            
            if (!empty($_GET['filter'])) {
                if ($_GET['filter'] == "console"){
                    $sql .= " ORDER BY game.console";
                    $_SESSION['filter']="filter=console";
                }
                if ($_GET['filter'] == "developer"){
                    $sql .= " ORDER BY dev.developer";
                    $_SESSION['filter']="filter=developer";
                }
                if ($_GET['filter'] == "publisher"){
                    $sql .= " ORDER BY pub.publisher";
                    $_SESSION['filter']="filter=publisher";
                }
                
                if ($_GET['sortBy'] == "asc"){
                    $sql .= ", price";
                    $_SESSION['sortBy']="sortBy=asc";
                }
                if ($_GET['sortBy'] == "desc"){
                    $sql .= ", price DESC";
                    $_SESSION['sortBy']="sortBy=desc";
                }
            }
            
            else if ($_GET['sortBy']=="asc"){
                $sql .= " ORDER BY game.price";
                $_SESSION['sortBy']="sortBy=asc";
            }
            else if ($_GET['sortBy']=="desc") {
                $sql .= " ORDER BY price DESC";
                $_SESSION['sortBy']="sortBy=desc";
            }
            else {
                $sql .= " ORDER BY name";
            }
        }
        else {
            $sql .= " ORDER BY name";
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $games;
    }
    
?>

<html>
    <head>
        <title>Team Project</title>
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id = 'wrapper'>
        <div id = 'mario'>
       <a href="https://fontmeme.com/new-super-mario-bros-wii-font/"><img src="https://fontmeme.com/permalink/171108/735136f2d3010640743b73d15e0b752f.png" alt="new-super-mario-bros-wii-font" border="0"></a>
       </div>
       
        <div id = 'sButton'> 
        <form action='shoppingCart.php'>
                <input type='submit' class = 'button' value='Shopping Cart'>
                
        </form>
          <form action='refresh.php'>
                <input type='submit' class = 'button' value='Start New Session'>
        </form>
        
        </div>
        
        <div id = 'upper'>
        <form>
            Order by Price:
            <input type="radio" name="sortBy" id="asc" value="asc"
                <?= ($_GET['sortBy']=="asc")?"checked":""  ?>
            />
             <label for="asc">Ascending</label>
            <input type="radio" name="sortBy" id="desc" value="desc" 
               <?= ($_GET['sortBy']=="desc")?"checked":""  ?>
            />
             <label for="desc">Decending</label>
            </br>
            Filter by: 
            <select id=filter name="filter">
                <option value=""> Select One </option>
                <option value="console"  <?php if ($_GET['filter'] == "console" ) echo 'selected' ; ?>>Console</option>
                <option value="publisher"  <?php if ($_GET['filter'] == "publisher" ) echo 'selected' ; ?>>Publisher</option>
                <option value="developer" <?php if ($_GET['filter'] == "developer" ) echo 'selected' ; ?>>Developer</option>
            </select>
             
            <input type="submit" class = "button" value="Search" name="submit" />
        </form>
        </div>
 
 
        <?php
        $games = displayGames();
     
        echo "<table>";
        echo "<tr>
                <th>Game</th>
                <th>Console</th>
                <th>Publisher</th>
                <th>Developer</th>
                <th>Year</th>
                <th>Metacritic Score</th>
                <th>Price</th>
                <th> </th>
              </tr>";
        foreach($games as $g) {
            echo "<tr>";
            echo "<td><a href='gameInfo.php?vgID=".$g['vgID']."'> ".ucwords($g['name'])."</a></td>";
            echo "<td>".ucwords($g['console'])."</td>";
            echo "<td>".ucwords($g['publisher'])."</td>";
            echo "<td>".ucwords($g['developer'])."</td>";
            echo "<td>".ucwords($g['year'])."</td>";
            echo "<td>".ucwords($g['metacritic'])."</td>";
            echo "<td>".ucwords($g['price'])."</td>";
            echo "<td><form action='addToCart.php' style='display:inline'>
                    <input type='hidden' name='vgID' value='".$g['vgID']."'/>
                    <input type='submit' class = 'button' value='Add to Cart'>
                  </form></td>";
            echo "</tr>";
        }
        
        echo "</table>";
       
        ?>
        

       
        
        

    </body>
</html>