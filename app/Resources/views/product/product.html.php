<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
$this->extend('layout.html.php');
?>

<head> 
<style>
* {
  box-sizing: border-box;
    background-image: url('../images/Background.jpg');
     background-repeat: no-repeat;
   background-attachment: fixed;
  background-size: 100% 100%;
}
table {
  border-collapse: collapse;
  width: 100%;
} 

.pagination {
  display: inline-block;
}

.pagination a {
  color: grey;
  float: left;
  padding: 8px 16px;
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
}

#myInput {
  background-image: url('/css/searchicon.png'); 
  background-position: 10px 12px; 
  background-repeat: no-repeat;
  width: 200px;
  font-size: 16px; 
  padding: 12px 20px 12px 20px;
  border: 1px solid #ddd; 
  margin-bottom: 12px; 
}

</style>


</head>
<p><?= $this->input("headline", ["width" => 540]); ?></p>

	<?= $this->image("myImage", [
    "title" => "Drag your image here",
    "width" => 200,
    "height" => 200,
    "thumbnail" => [
        "width" => 200,
        "height" => 200,
        "interlace" => true,
        "quality" => 90
    ]
]); ?>


<?= $this->wysiwyg("specialContent"); ?>

<div class="product-info">
    <?php 
    if($this->editmode):
       
    else: ?>

    <div id="product">
  
      <?php
      $pageLimit = 4;

      if (isset($_GET["page"])) {
        $page  = $_GET["page"];    
      }    
      else {
        $page = 1;    
      } 
      $offset = ($page-1) * $pageLimit; 

    $prod = new \Pimcore\Model\DataObject\Product\Listing();

    $products = count($prod);
    $prod->setLimit($pageLimit);
    if($offset > 0){
      $prod->setOffset($offset);
    }
    else{
      $prod->setOffset(0);
    }
    ?>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Here">

        <table class="d" id="myTable2">
            <tr>
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
                <th >Manufacture Date</th>
                <th >Image</th>
                
            </tr>            
        </table>
        
       <table class="d" id="myTable">
       <tbody>
       <?php
        foreach($prod as $product) 
        {
          if($product->getStatus() == "Available")
          {
            ?>
            
            <tr >
            
            <td ><?=$product->getSKU(); ?></td>
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
            <td ><?=$product->getManufactureDate(); ?></td>

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
     } 
     ?>  
       </tbody>          
        </table>
        
    </div>
    <?php endif; ?>
    <center>
      <div class="pagination" >    
      <?php
      if(!$this->editmode) {
        echo "</br>";     
        $pageCount = ceil($products / $pageLimit);     
        $gotoPage = "";       
      
        if($page >= 2){   
            echo "<a href='http://pim.local/productListing?page=".($page-1)."'>  Prev </a>";   
        }       
                    
        for ($i = 1; $i <= $pageCount; $i++) {
              
          if ($i == $page) {   
              $gotoPage .= "<a class = 'active' href='http://pim.local/productListing?page=".$i."'>".$i." </a>";   
          }         
          else  {   
              $gotoPage .= "<a href='http://pim.local/productListing?page=".$i."'>".$i." </a>";     
          }   
        };     
        echo $gotoPage;
            
        if($page<$pageCount){   
            echo "<a href='http://pim.local/productListing?page=".($page+1)."'>  Next </a>";   
        }
      }
      ?>    
      </div>
        </center>
</div>

<!-- <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script> -->

