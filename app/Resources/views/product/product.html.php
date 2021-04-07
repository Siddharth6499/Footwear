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
    background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgUZOTSuovOBvspr4mDuOzgBdhKOnJnARShQ&usqp=CAU');
     background-repeat: no-repeat;
   background-attachment: fixed;
  background-size: 100% 100%;
}
table {
  border-collapse: collapse;
  width: 100%;
} 



table.d {
  table-layout: fixed;
  width: 100%;  
}

th,td {
  border: 1px solid white;
  text-align: left;
  padding: 8px;
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

</style>
</head>
<p><?= $this->input("headline", ["width" => 540]); ?></p>

`		<?= $this->image("myImage", [
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
            $prod = new \Pimcore\Model\DataObject\Product\Listing();

       
        ?>
        <table class="d">
            <tr>
            	 <th  >SKU</th>
                <th  >Name</th>
                <th  >Description</th>
                <th  >Brand</th>
                <th  >Price</th>
                <th  >Size</th>
                <th  >Discount</th>
                <th  >Color</th>
                <th  >Category</th>
                <th  >Group Type</th>
                <th  >Made in Country</th>
                <th  >Returnable</th>
                <th  >Status</th>
                <th  >Manufacture Date</th>
                <th  >Image</th>
                
            </tr>            
        </table>
        
       <table class="d">
       <tbody>
       <?php
        foreach($prod as $product) 
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
            <td ><?=$product->getCategory(); ?></td>           
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
     ?>  
       </tbody>          
        </table>
    </div>
    <?php endif; ?>
</div>