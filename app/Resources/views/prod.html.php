<?php
echo $this->ta;
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Siddharth Srivastava">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> </title>
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<style>
* {
  box-sizing: border-box;
    background-image: url('https://images.unsplash.com/photo-1585314062604-1a357de8b000?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1351&q=80');
     background-repeat: no-repeat;
   background-attachment: fixed;
  background-size: 100% 100%;
}
table {
  border-collapse: collapse;
  width: 100%;
} 

.form-control form-control-sm{
    color: white;
}
.container{
    margin-right: 30%;
}

.pagination { 
  display: inline-block;
}

.pagination a {
  color: white;
  float: left;
  padding: 8px 12px;
  text-decoration: none;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: #1D243A;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}



table.d {
  table-layout: fixed;
  width: 100%;  
}

th,td {
  border: 1px solid white;
  text-align: left;
  padding: 8px;
  color: rgb(211, 180, 180)
}

th {
  background-color: #1D243A;
  color: white;
  cursor: pointer;
}


p {
  font-family: "Sofia", sans-serif;
  font-size: 30px;
  text-shadow: 3px 3px 3px #ababab;
  color: white;
}

#myInput {
  background-image: url('/css/searchicon.png'); 
  color: whitesmoke;
  background-position: 10px 12px; 
  background-repeat: no-repeat;
  width: 200px;
  font-size: 16px; 
  padding: 10px 18px 10px 18px;
  border: 1px solid #ddd; 
  margin-bottom: 12px; 
}

</style>
</head>


<body class="bg-info text-white">
<?= $this->wysiwyg("specialContent"); ?>
     
<div class="background">
  <div class="container"><div class="screen">
     <div class="screen-header text-white">
               <div class="screen-header-button close"></div>
          <div class="screen-header-button maximize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
 
    <div class="screen">
   
<div class="product-info text-white">
    <?php
    if($this->editmode):
       
    else: ?>

   <div class="container text-white">
  <div class="row justify-content-center text-white">
  <div class="col-lg-10 bg-light rounded my-2 py-2 text-white">
  <h4 class="text-center text-white pt-2">Product Listing</h4><hr>
   <table class="table table-bordered table-striped table-hover">
     
           <thead>   <tr>
           
            <th >SKU</th>
            <th >Name</th>
            <th >Description</th>
            <th >Brand</th>
            <th >Price</th>
            <th >Size</th>
            <th >Discount</th>
            <th >Color</th>
            <th >Category</th>
            <th >Group Type</th>
            <th >Made in Country</th>
            <th >Returnable</th>
            <th >Status</th>
            <th >Image</th>
               
            </tr>    </thead>          
   
       
 <div class="screen-body">
   
      <tbody>
  <?php $prod = new \Pimcore\Model\DataObject\Product\Listing(); ?>
       <?php
        foreach($prod as $product)
        {
            ?>
           
            <tr >
            <td ><?=$product->getSku(); ?></td>
            <td ><?=$product->getName(); ?></td>
            <td ><?=$product->getDescription(); ?></td> 
            <td ><?=$product->getBrand(); ?></td>
            <td ><?=$product->getPrice(); ?></td>
            <td ><?=$product->getSize(); ?></td>
            <td ><?=$product->getDiscount(); ?></td>
            <td ><?=$product->getColor(); ?></td> 
            <td ><?=$product->getCategory()->getName(); ?></td>           
            <td ><?=$product->getGroupType(); ?></td>
            <td ><?=$product->getMadeIn(); ?></td>
            <td ><?=$product->getReturnable(); ?></td>
            <td ><?=$product->getStatus(); ?></td>
           
           
            <?php


            $picture = $product->getImage();
              if($picture instanceof \Pimcore\Model\Asset\Image):

            /** @var \Pimcore\Model\Asset\Image $Image */
            ?>

         <td><?= $picture->getThumbnail()->getHtml(["width" => 100,"height" => 100])?> </td>
           
           
            <?php endif;
           
            ?>
           
            </tr>
        <?php
     }
     ?>  
       </tbody>          
        </table></div></div>
    </div> </div>  </div>
    </div>
    </div>
   <!-- <?php endif; ?> -->
 
</div>
</div>
<script type="text/javascript">


$(document).ready(function(){
$('table').DataTable();


} );

</script>
  </body>
 
  </html>