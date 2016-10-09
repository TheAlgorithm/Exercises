function fetchAllData(){
    var xhttp = new XMLHttpRequest();
    var methParam = "functionSelector=getData";
        xhttp.onreadystatechange = function(){
            if (xhttp.readyState == 4 && xhttp.status == 200){
                    
                
              document.getElementById("post-list").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("POST", "data-service.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(methParam);
}


function ajaxDataPost(){
    var xhttp = new XMLHttpRequest();
    var url ="data-service.php";
    var name = document.getElementById("name").value;
    var blogpost = document.getElementById("blogpost").value;
    var functionSelect = "postData"

    var varQuery = "functionSelector="+functionSelect+"&name="+name+"&blogpost="+blogpost;

    xhttp.open("POST", url, false);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200){
            document.getElementById("status").innerHTML = xhttp.responseText;
            
        }
    }
    xhttp.send(varQuery);
    clearForm();
    fetchAllData();
}

function ajaxDataDelete(indexToDelete){

    
    var xhttp = new XMLHttpRequest();
    var url= "data-service.php";
    var functionToSelect = "deleteData";
    var varMethQuery = "functionSelector="+functionToSelect+"&deleteIndex="+indexToDelete;

    xhttp.open("POST", url, true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200){
            document.getElementById("status").innerHTML = xhttp.responseText;
        }
        
    }
    xhttp.send(varMethQuery);
    fetchAllData();
}

function clearForm(){
    document.getElementById('name').value = "";
    document.getElementById('blogpost').value = "";
}
