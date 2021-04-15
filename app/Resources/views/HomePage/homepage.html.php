<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Footwear Shop</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <img class="center" alt="Logo" width="140" height="140" src="/myassets/logo1.png">
    <div class="navbar navbar-default">
        <ul style="padding-left:420px;">
            <li><a href="/homePage">Home</a></li>
            <li><a href="/productListing">Products</a></li>
            
            <li><a href="#about">About</a></li>
            <li><a href="/feedback">Feedback</a></li>
        </ul>
    </div>
  </head>
  <style media="screen">
  
  .carousel-cell {
    width: 100%;
    }

    /* cell number */
    .carousel-cell:before {
      display: block;
    }
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  }
  
  navbar {
  
    text-align: center;
    height: 100px;
    text-decoration: none;
    color: #black;
    margin-left: auto;
  margin-right: auto;
}

ul{

    text-decoration: none;
    color: black;
    padding: 0;
    margin-left: 14%;
}

li{
    display: inline-block;
    margin: 1rem;
}

li a{
    text-decoration: none;
    color: black;
    font-size: 20px;
    font-family: 'Roboto Mono', monospace;
}

li a:hover{
    color: Red;
}

  .about{
    min-height: 200px;
    margin: 50px 0px 50px 0px;
    padding: 25px 50px;
    background-color: var(--lightgrey);
    text-align: center;
}

.about h2{
    font-size: 32px;
    font-family: 'Roboto Mono', monospace;
}

.about p{
    font-size: 20px;
}

  
 
}
  </style>
  <body >
  
    <h1 style = "text-align:center;font-family:georgia,garamond,serif;font-size:60px;font-style:italic;" >The Footwear Shop</h1>
    <div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay": true, "imagesLoaded":true }'>
      <div class="carousel-cell">
        <img class="w3-image" src="/images/t3.jpg">
      </div>
      <div class="carousel-cell">
        <img class="w3-image" src="/images/t4.jpg">
      </div>
      <div class="carousel-cell">
        <img class="w3-image" src="/images/t5.jpg">
      </div>
    </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
      <!-- About Section -->
    <div id="about" class="about">
        <h2>About Us</h2>
        <p>‘Life Kicks-The Footwear Store’ is your place for athletic and easygoing shoes for the entire family from many name brands. You’ll discover styles for ladies, men and children from brands like Nike, Converse, Vans, Sperry, Madden Girl, Skechers, ASICS and then some! With stores in the U.S. furthermore, Canada and much more choice online at Famous.com and FamousFootwear.ca, ‘Life Kicks-The Footwear Store’ is a main family footwear goal for the popular brands you know and love. </p>
    </div>

  </body>
  
  <!-- Footer -->
    <footer style="text-align:center;padding:10px">
        <p>Contact Us- thofootwearstore@gmail.com</p>
        <h4>The Footwear Store&reg;</h4>
    </footer>
</html>