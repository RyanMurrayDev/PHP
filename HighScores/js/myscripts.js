function sendAjaxRequest(method, url,successCallback,data)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           successCallback(this);
        }
    };
    if( method === "GET")
    {
        if(data)
        {
            let query = new URLSearchParams(data).toString();
            //console.log("query: " + query);
            xhttp.open(method, url+"?"+query , true);
            xhttp.send();
        }
        else
        {
            xhttp.open(method,url,true);
            xhttp.send();
        }
    }
    else if(method === "POST")
    {
        xhttp.open(method,url,true);
        xhttp.send(data);
    }
}
$(document).ready(function(){
    $("#sendButton1").click(function(evt){
        //Get top 10 scores for all users for the given game title
        let form1 = document.getElementById("form1");
        let data = new FormData(form1);
        console.log(data);
        for(let entry of data.entries())
        {
            console.log(entry);
        }
       sendAjaxRequest("POST","controllers/topTenGame.php",
            function(xhttp){
                $("#section1").html(xhttp.responseText);
            },data);
    });
    $("#sendButton2").click(function(evt){
        //Get top 10 scores for the given user for the given game title
        let form2 = document.getElementById("form2");
        let data = new FormData(form2);
        console.log(data);
        for(let entry of data.entries())
        {
            console.log(entry);
        }
        sendAjaxRequest("POST","controllers/topTenUser.php",
            function(xhttp){
                $("#section2").html(xhttp.responseText);
            },data);
    });
    $("#sendButton3").click(function(evt){
        //Get top 5 scores for the given user for the given game title
        //     (scores will be within the last 8 hrs)
        let form3 = document.getElementById("form3");
        let data = new FormData(form3);
        console.log(data);
        for(let entry of data.entries())
        {
            console.log(entry);
        }
        sendAjaxRequest("POST","controllers/topFiveUser.php",
            function(xhttp){
                $("#section3").html(xhttp.responseText);
            },data);
    });
    $("#sendButton4").click(function(evt){
        //Insert a user
        let form4 = document.getElementById("form4");
        let data = new FormData(form4);
        console.log(data);
        for(let entry of data.entries())
        {
            console.log(entry);
        }
        sendAjaxRequest("POST","controllers/insertScore.php",
            function(xhttp){
                $("#section4").html(xhttp.responseText);
            },data);
    });
});