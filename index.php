
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style type="text/css">
        html {
            background: url(backgrnd.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body{
            background: none;
        }
        .container{
            text-align: center;
            margin-top: 200px;
            width: 500px;
        }

    </style>


</head>
<body>

<?php
if(isset($_GET['city'])){

        //$weather = '';
        //$error = '';

        $city=str_replace(' ','',$_GET['city']);

        $file_header = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        if ($file_header[0]== 'HTTP/1.1 404 Not Found'){

            $error = "That city could not be found";
            //echo $error;
        }
        else{

        $forecastpage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        $pagearray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$forecastpage);
        $pagearray1= explode('</span></span></span></p><div class="forecast-cont">',$pagearray[1]);
        $weather= $pagearray1[0];

        }

}

?>



    <div class="container">
        <h1> How's the Weather </h1>
        <p> Enter name of the city</p>


        <form action="index.php" method="get">
            <div class="form-group">

                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City Name. Eg. New York, San Antonio" value="<?php if(isset($_GET['city'])){echo $_GET['city'];}; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>


                <?php
                    if(isset($weather)){
                        echo '<br> <div class="alert alert-secondary" role="alert">'.$weather.'</div>';
                    }
                    else if(isset($error)) {
                        echo '<br> <div class="alert alert-secondary" role="alert">'.$error.'</div>';
                    }
                ?>



    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>




