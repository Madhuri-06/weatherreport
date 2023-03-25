<?php
$weather="";
$error="";
if($_GET){
if($_GET["city"]){
  $_GET["city"]=str_replace(' ','',$_GET["city"]);
  $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest");
  if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      $error="City does'nt Exists";
    }
  else {
  $forecastpage=file_get_contents("https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest");
  $pageArray=explode('<p class="b-forecast__table-description-content"><span class="phrase">',$forecastpage);
  if(sizeof($pageArray)>1){
  $secondpageArray= explode('</span></p>',$pageArray[1]);
    if(sizeof($secondpageArray)>1){
        $weather= $secondpageArray[0];
      }
    else{
        $error="City does'nt Exists";
      }
    }
  else{
       $error="City does'nt Exists";
}}}}
?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>Weather Scraper</title>
    <style type="text/css">
      html { 
            background: url(weather.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
`           }
      body{
            background:none;
      }
      h1{
         font-size:250px;
         text-align:center;
         margin-top:400px;
      }
      h2{
         font-size:150px;
         text-align:center;
         margin-top:200px;
      }
      #city{
          width:40%;
          height:150px;
          margin:0 auto;
          margin-top:200px;
        }
        #bt{
          width:200px;
          margin:0 auto;
          padding-top:100px;
        }
        .contain{
          display: flex;
          flex-direction:column;
          justify-content: center;
        }
        button{
          width:250px;
          height:130px;
        }
        .btn,.form-control{
          font-size:60px;
        }
        #weather{
          width:fit-content;
          height:fit-content;
          padding-top:200px;
          margin: 0 auto;
          font-size:100px;
        }
      
    </style>
  </head>
  <body>
   <form method="Get"> 
   <div class="contain">
        <h1>What's The Weather?</h1>
        <div class="form-group">
          <h2>Enter the name of City</h2>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg.India,london">
        </div>
        <div id="bt"><button type="submit" class="btn btn-primary">Submit</button></div>
       <div id="weather">
          <?php 
          if("$weather"){
          echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
          } 
          else if("$error"){
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
          }?>
      </div>
   </div>
  </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

