<?php



if(isset($_POST["functionSelector"])){

  $functionName = $_POST["functionSelector"];
    switch($functionName){
      case "getData":
          getData();
          break;
      case "postData":
          postData();
          break;
      case "deleteData":
          deleteData();
          break;
    }
}


function getData(){
    require "conntest.php";
   
    $mysql_all_qry = "SELECT * FROM blogpost ORDER BY id";
    $result = mysqli_query( $conn, $mysql_all_qry);

    if(empty($result)){
      echo ("nothing posted yet");
    }else{
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo ("id:{$row['id']}<br>
                      name: {$row['name']}<br>
                      post: {$row['message']}<br>
                      <input type='submit' name='deleteBtn:{$row['id']}' value='Delete Post' onClick='javascript:ajaxDataDelete({$row['id']});'><br>
                      <br>");
               
         }
    }
  $conn->close();
}

function postData(){
    require "conntest.php";
      $errorMessage ="";

    
          if(empty($_POST['name']) OR empty($_POST['blogpost']) ){
              
              $errorMessage = "Please fill in both inputfields";

          }else{
                  $varName = $_POST['name'];
                  $varBlogpost = $_POST['blogpost'];
                  
                 $mysql_qry = "INSERT INTO blogpost (name,message) VALUES ('$varName', '$varBlogpost')";

                  if($conn->query($mysql_qry) === TRUE){
                        echo "Insert Successful";
                  }else{
                        echo "Error: " . $mysql_qry . "<br>" . $conn->error;
                  }
          


         
          }
       
        if(!empty($errorMessage))
            {
              echo("there was an error with your form:\n");
              echo($errorMessage);
            } 
     $conn->close();
}



function deleteData(){
      require "conntest.php";
         
            $errorMessage="";
            $indexVar = $_POST['deleteIndex'];

            if(!$indexVar){
              $errorMessage ="There is no such post. Please select another one.";
              echo($errorMessage);
            }else{
              $mysql_delete_qry = "DELETE FROM blogpost WHERE id=$indexVar";

              if($conn->query($mysql_delete_qry)===TRUE){
                  echo ("Blogpost #".$indexVar." deleted");
              }
            }

    
      $conn->close();
}
?>