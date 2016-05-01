<?php


class HomePage extends Page
{
    private static $allowed_children = "none";

    private static $has_many = array(
        'Products' => 'Product'
    );


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Main');

        $fields->addFieldToTab('Root.Products', GridField::create(
            'Products',
            'Products on this page',
            $this->Products(),
            GridFieldConfig_RecordEditor::create(3)


        ));
        return $fields;
    }

    public function canCreate($member = null)
    {
        return parent::canCreate($member) ? HomePage::get()->count() == 0 : false;
    }
}
class HomePage_Controller extends Page_Controller
{
    public $filter;

    public static $dependencies = array(
        'filterProducts' => '%$FilterProducts',
    );

    private static $allowed_actions = array(
        'doProductSearch'
    );

    public function productSearchForm()
    {
        $options = array(
            'PriceHighest' => 'Pris: högsta',
            'PriceLowest' => 'Pris: lägsta',
            'DateNewest' => 'Tillagd: senaste',
            'DateOldest' => 'Tillagd: äldsta',
        );

        $fields = new FieldList(
            $sortField = new DropdownField('Sort', 'Sortera', $options, '', $fields, '-- Välj ett filter --')
        );

        $sortField->addExtraClass('form-group')->setAttribute('class', 'form-control');

        $actions = new FieldList(
            $submit = new FormAction('doProductSearch', 'Sök')
        );


        $submit->setAttribute('class', 'btn btn-search');

        $form = new Form($this, 'doProductSearch', $fields, $actions);

        $form->setFormMethod('GET')
             ->addExtraClass('form-inline')
             ->disableSecurityToken()
             ->loadDataFrom($this->request->getVars());
                          
        return $form;
    }

    public function Products()
    {
        return Product::get();
    }

    public function doProductSearch($data)
    {
        $formdata = $data->getVars('Sort');
        return array(
            'Results' => $this->filterProducts->filter($formdata['Sort'])
        );
    }
}
