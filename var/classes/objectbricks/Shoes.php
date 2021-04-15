<?php 

/** 
Fields Summary: 
- shoesType [select]
*/ 


return Pimcore\Model\DataObject\Objectbrick\Definition::__set_state(array(
   'classDefinitions' => 
  array (
    0 => 
    array (
      'classname' => 'Product',
      'fieldname' => 'variants',
    ),
  ),
   'dao' => NULL,
   'key' => 'Shoes',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => '',
   'group' => '',
   'layoutDefinitions' => 
  Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
     'fieldtype' => 'panel',
     'labelWidth' => 100,
     'layout' => NULL,
     'border' => false,
     'name' => NULL,
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => NULL,
     'height' => NULL,
     'collapsible' => false,
     'collapsed' => false,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'permissions' => NULL,
     'childs' => 
    array (
      0 => 
      Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
         'fieldtype' => 'panel',
         'labelWidth' => 100,
         'layout' => NULL,
         'border' => false,
         'name' => 'Layout',
         'type' => NULL,
         'region' => NULL,
         'title' => '',
         'width' => NULL,
         'height' => NULL,
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
             'fieldtype' => 'select',
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Boat',
                'value' => 'Boat',
              ),
              1 => 
              array (
                'key' => 'Blucher',
                'value' => 'Blucher',
              ),
              2 => 
              array (
                'key' => 'Bast',
                'value' => 'Bast',
              ),
              3 => 
              array (
                'key' => 'Ballet',
                'value' => 'Ballet',
              ),
            ),
             'width' => '',
             'defaultValue' => '',
             'optionsProviderClass' => '',
             'optionsProviderData' => '',
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 190,
             'phpdocType' => 'string',
             'dynamicOptions' => false,
             'name' => 'shoesType',
             'title' => 'shoesType',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => NULL,
             'style' => '',
             'permissions' => NULL,
             'datatype' => 'data',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'defaultValueGenerator' => '',
          )),
        ),
         'locked' => false,
         'icon' => '',
      )),
    ),
     'locked' => false,
     'icon' => NULL,
  )),
   'generateTypeDeclarations' => false,
));
