<?php

class Product extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar',
        'Date' => 'Date',
        'Description' => 'Text',
        'Ingredients' => 'HTMLText',
        'Price' => 'Currency',
    );

    private static $has_one = array(
        'Photo' => 'Image',
        'HomePage' => 'HomePage',
    );


    private static $summary_fields = array(
        'GridThumbnail' => 'Image',
        'Title' => 'Product name',
        'Description' => 'Description',
        'Price' => 'Price'
    );

    public function getGridThumbnail()
    {
        return ($this->Photo()->exists()) ? $this->Photo()->setSize(100, 100) : 'no image';
    }

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            TextareaField::create('Description'),
            DateField::create('Date')->setConfig('showcalendar', true)
                ->setConfig('dateformat', 'd MMMM yyyy'),
            TextField::create('Price'),
            HtmlEditorField::create('Ingredients'),
            $uploader = UploadField::create('Photo')
        );

        $uploader->setFolderName('product-photos');

        $uploader->getValidator()->setAllowedExtensions(array(
            'jpg', 'png', 'jpeg', 'gif'
        ));

        return $fields;
    }

    public function Link()
    {
        return $this->ProductPage()->Link('show/'.$this->ID);
    }
}
