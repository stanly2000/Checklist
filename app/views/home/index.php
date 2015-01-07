<?php

echo "This is View file which belonges to Controller Home Method Index";?>

<div class="jumbotron">
    <h1>Checklist</h1>
    <p class="lead">We are creating a an application that let's you manage all the tasks that you have within a small or large group.</p>
</div>


<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        h2 {
            margin: 0;
            color: #666;
            padding-top: 90px;
            font-size: 52px;
            font-family: "trebuchet ms", sans-serif;
        }
        .item {
            background: #333;
            text-align: center;
            height: 400px !important;
        }
        .carousel {
            margin-top: 20px;
        }
        .bs-example {
            margin: 20px;
        }
    </style>

</head>

<body>
    
    <div class="bs-example">
        
        <div id="myCarousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="active item">
                    <div class="carousel-caption">
                        <link rel="icon" type="image/png" href="<?php echo RESOURCE ;?>/img/checklist1.jpg" alt=" ...">
                    </div>
                </div>
                <div class="item">
                    <div class="carousel-caption">
                        <img src="<?php echo RESOURCE ;?>/img/checklist1.jpg" alt=" ...">
                    </div>
                </div>
                <div class="item">
                    <div class="carousel-caption">
                        <img src="<?php echo RESOURCE ;?>/img/checklist1.jpg" alt=" ...">
                    </div>
                </div>
            </div>

            <!-- Carousel navigation -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>    
</body>
</html>
