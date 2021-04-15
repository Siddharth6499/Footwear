<?php

namespace AppBundle\Command;

use Pimcore;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\Asset\MetaData\ClassDefinition\Data\Asset;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Import;
use Pimcore\Model\DataObject\Log;



class ProductCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('pimcore:csvCommand')
            ->setDescription('imports csv files');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $object = new \Pimcore\Model\DataObject\Import\Listing();
        $object->setCondition('name = ?', 'Product');
        // $object->addConditionParam('status = ?', false);
        $object->setLimit(1);

        foreach ($object as $path) {
            $file = $path->getFile();
            $file = (PIMCORE_PROJECT_ROOT . '/web/var/assets' . $file->getPath() . $file->getFilename());
            // p_r($file);
            // die;
        }
        $h = fopen($file, "r");
        if ($h !== FALSE) {
            while (!feof($h)) {

                $cid[] = fgetcsv($h);
                $num = count($cid);
            }
            foreach ($cid[0] as $single_csv) {
                $cidName[] = $single_csv;
            }
            foreach ($cid as $val => $csv) {
                if ($val == FALSE) {
                    continue;
                }
                foreach ($cidName as $cidKey => $colName) {
                    $datas[$val - 1][$colName] = $csv[$cidKey];
                }
            }
            $count = 1;
            $json = json_encode($datas);
            fclose($h);
        }
        $data = json_decode($json);
        foreach ($data as $prod) {

                if ($prod->key != NULL) {
                    try{
                    $object = new Pimcore\Model\DataObject\Product();
                    $object->setKey($prod->key);
                    $object->setParentId(126);
                    $object->setPublished(true);
                    $object->setSKU($prod->SKU);
                    $object->setName($prod->name);
                    $unit = DataObject\QuantityValue\Unit::getByAbbreviation('Rs');
                    $object->setPrice(new DataObject\Data\QuantityValue($prod->price, $unit->getId()));
                    $object->setBrand($prod->brand);
                    $object->setSize($prod->size);
                    $object->setDescription($prod->description);
                    $unit = DataObject\QuantityValue\Unit::getByAbbreviation('%');
                    $object->setDiscount(new DataObject\Data\QuantityValue($prod->discount, $unit->getId()));
                    $object->setReturnable($prod->returnable);
                    $object->setMadeIn($prod->madeIn);
                    $object->setStatus($prod->status);
                    $object->setGroupType($prod->groupType);
                    $image = \Pimcore\Model\Asset\Image::getByPath($prod->image);
                    $object->setImage($image);
                    $t = new \Pimcore\Model\DataObject\Data\RgbaColor();
                    $t->setRgba($prod->color);
                    $object->setColor($t);
                    $category = new \Pimcore\Model\DataObject\Category\Listing();
                    $category->setCondition('name = ?', $prod->category);
                    $category->setLimit(1);
                        foreach ($category as $cat) {
                            $object->setCategory($cat);
                        }
                    $manufactureDate = \Carbon\Carbon::parse($prod->manufactureDate);
                    $object->setManufactureDate($manufactureDate);
                    
                        $objBrick = new DataObject\Objectbrick\Data\Casual($object);
                        $objBrick->setTypes($prod->types);
                    
                        $object->getVariants()->setCasual($objBrick);
                    
                    
                        $Brick = new DataObject\Objectbrick\Data\Sandals($object);
                        $Brick->setHeelType($prod->heelType);
                       
                        $object->getVariants()->setSandals($Brick);


                        $Brick = new DataObject\Objectbrick\Data\Sports($object);
                        $Brick->setsportsshoesType($prod->sportsshoesType);
                       
                        $object->getVariants()->setSports($Brick);

                        $Brick = new DataObject\Objectbrick\Data\Shoes($object);
                        $Brick->setShoesType($prod->shoesType);
                       
                        $object->getVariants()->setShoes($Brick);

                        $object->save();


                        
                        $this->dump("Data Imported Successfully");

                    }
                    catch(\Exception $e)
                    {

                    $msg = "";
                    if($prod->SKU==NULL)
                    {
                     $msg .= "SKU is given NULL. \n";
                    }
                    if($prod->name==NULL)
                    {
                    $msg .= "Name is given NULL. \n";
                    }
                    if($prod->price==NULL)
                    {
                        $msg .= "Price is given NULL. \n";
                    }
                    if($prod->brand==NULL)
                    {
                        $msg .= "Brand is given NULL. \n";
                    }
                    if($prod->size==NULL)
                    {
                        $msg .= "Size is given NULL. \n";
                    }
                    if($prod->description==NULL)
                    {
                        $msg .= "Description is given NULL. \n";
                    }
                    if($prod->discount==NULL)
                    {
                        $msg .= "Discount is given NULL. \n";
                    }
                    if($prod->madeIn==NULL)
                    {
                        $msg .= "MadeIn is given NULL. \n";
                    }
                    if($prod->status==NULL)
                    {
                        $msg .= "Status is given NULL. \n";
                    }
                    if($prod->groupType==NULL)
                    {
                        $msg .= "Group Type is given NULL. \n";
                    }
                    if($prod->image==NULL)
                    {
                        $msg .= "Image is given NULL. \n";
                    }
                    if($prod->color==NULL)
                    {
                        $msg .= "Color is given NULL. \n";
                    }
                    else
                    {
                        $msg = "Data Imported Successfully";
                    }


                        $logMsg=new \Pimcore\Model\DataObject\Log();        
                        $logMsg->setKey("$prod->key");
                        $logMsg->setPublished(true);
                        $logMsg->setParentId(74);
                        $logMsg->setMessage($msg);
                        $logMsg->save();
                        $this->dump($logMsg->getKey()) or die;

                        continue;
                    }
                    


                    
                    $msg = "";
                    if($prod->SKU==NULL)
                    {
                     $msg .= "SKU is given NULL. \n";
                    }
                    if($prod->name==NULL)
                    {
                    $msg .= "Name is given NULL. \n";
                    }
                    if($prod->price==NULL)
                    {
                        $msg .= "Price is given NULL. \n";
                    }
                    if($prod->brand==NULL)
                    {
                        $msg .= "Brand is given NULL. \n";
                    }
                    if($prod->size==NULL)
                    {
                        $msg .= "Size is given NULL. \n";
                    }
                    if($prod->description==NULL)
                    {
                        $msg .= "Description is given NULL. \n";
                    }
                    if($prod->discount==NULL)
                    {
                        $msg .= "Discount is given NULL. \n";
                    }
                    if($prod->madeIn==NULL)
                    {
                        $msg .= "MadeIn is given NULL. \n";
                    }
                    if($prod->status==NULL)
                    {
                        $msg .= "Status is given NULL. \n";
                    }
                    if($prod->groupType==NULL)
                    {
                        $msg .= "Group Type is given NULL. \n";
                    }
                    if($prod->image==NULL)
                    {
                        $msg .= "Image is given NULL. \n";
                    }
                    if($prod->color==NULL)
                    {
                        $msg .= "Color is given NULL. \n";
                    }
                    else
                    {
                        $msg = "Data Imported Successfully";
                    }

                    $count++;
                    $logMsg=new \Pimcore\Model\DataObject\Log();        
                    $logMsg->setKey("$prod->key");
                    $logMsg->setPublished(true);
                    $logMsg->setParentId(74);
                    $logMsg->setMessage($msg);
                    $logMsg->save();


                    

                    $log=new \Pimcore\Model\DataObject\Import\Listing();
                    foreach($log as $prod)
                    {                    
                     //   $prod->setLog($msg);
                        $prod->setStatus(true);
                        $prod->save();
                    }
                    $mail = new \Pimcore\Mail();
                    // $mail->addTo('gargmansi24@gmail.com');
                    // $mail->setSubject('Products Imported Sucessfully');
                    $mail->setDocument('/importEmail');
                    // $mail->setParams($params);
                    $mail->send();
                   
                }
                

               
            }
            
        }
        
    }