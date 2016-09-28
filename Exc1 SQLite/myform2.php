

<?php
require "connlite.php";

    if(isset($_POST['submit']))
    {

      $errorMessage ="";
          if(empty($_POST['name']) OR empty($_POST['blogpost']) ){
                  if(empty($_POST['name'])){
                            $errorMessage .= "<li>You forgot to enter your name!</li>";
                  }else{
                             $errorMessage .= "<li>You forgot to enter your blogpost!</li>";
                  }
          }else{
                  $varName = $_POST['name'];
                  $varBlogpost = $_POST['blogpost'];



                  echo ("<br><?php echo $varName; ?>");
                  echo ("<br><?php echo $varBlogpost; ?>");

                  $mysql_qry = "INSERT INTO blogpost (name,message) VALUES ('$varName', '$varBlogpost')";

                  $result = $db->exec($mysql_qry);

                  if(!$result){
                        echo $db->lastErrorMsg();
                  }else{
                        // echo "Records created successfully";
                  }

          }




      if(!empty($errorMessage))
      {
        echo("<p>there was an error with your form:</p>\n");
        echo("<ul>" .$errorMessage . "</ul>\n");
      }
    }



?>


<form action="myform2.php" method="POST">


<input type="text" name="name" value="<?php if(isset($var)){ echo $var;} ?>"><br>
<input type="text" name="blogpost"value="<?php if(isset($var)){ echo $var;} ?>"><br><br>
<input type="submit" name="submit" value="Absenden">

</form>

<?php
      $sql_qry_all =<<<EOF
                  SELECT * from blogpost;
EOF;
      $ret2 =$db->query($sql_qry_all);




      while ($row2 = $ret2->fetchArray(SQLITE3_ASSOC)){
        $deleteIndexString = "delete".$row2['id'];
        echo "Name: " . $row2["name"] ."<br>";
        echo "Blogeintrag: " . $row2["message"] . "<br>";
        echo "Erstellungszeitpunkt: " . $row2["timestamp"] . "<br>";
        $arr = str_split($deleteIndexString,6);
        echo '<form action="myform2.php" method="GET">';
        echo "<input type='submit' name='delete'  value='Eintrag ".$arr[1]." Löschen'><br><br>";
        echo '</form>';
      }

      $index = "";
      if(!empty($_GET)){
       $deleteIndexString = $_GET['delete'];
       $arr2 = explode(" ", $deleteIndexString);
       echo $arr2[1];
       $index = $arr2[1];
      }



      $sql_qry_delete =<<<EOF
                      DELETE FROM blogpost WHERE id="$index";
EOF;
      $ret=$db->query($sql_qry_delete);





 ?>
