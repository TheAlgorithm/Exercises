

<?php
require "conntest.php";

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

                  if($conn->query($mysql_qry) === TRUE){
                        echo "Insert Successful";
                  }else{
                        echo "Error: " . $mysql_qry . "<br>" . $conn->error;
                  }
          }


      if(!empty($errorMessage))
      {
        echo("<p>there was an error with your form:</p>\n");
        echo("<ul>" .$errorMessage . "</ul>\n");
      }
    } 

    $conn->close();
?>


<form action="myform.php" method="POST">


<input type="text" name="name" value="<?php if(isset($var)){ echo $var;} ?>"><br>
<input type="text" name="blogpost"value="<?php if(isset($var)){ echo $var;} ?>"><br><br>
<input type="submit" name="submit" value="Absenden">

</form>

<?php
require "conntest.php";
   
    $mysql_all_qry = "SELECT * FROM blogpost";

    
    $result = mysqli_query( $conn, $mysql_all_qry);

    if(empty($result)){
      echo ("nothing posted yet");
    }else{
          while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                echo ("name: {$row['name']}<br>
                      post: {$row['message']}<br>");
               
         }
    }

  
  $conn->close();

?>
