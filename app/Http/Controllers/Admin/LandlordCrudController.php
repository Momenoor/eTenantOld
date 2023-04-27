<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LandlordRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LandlordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LandlordCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Landlord::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/landlord');
        CRUD::setEntityNameStrings('landlord', 'landlords');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('display_name');
        CRUD::column('phone');
        CRUD::column('email');
        CRUD::column('bank_name');
        CRUD::column('bank_account_name');
        CRUD::column('bank_account_number');
        CRUD::column('user');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setCreateView('backpack::landlord.create');
        CRUD::setValidation(LandlordRequest::class);

        CRUD::field('name')->wrapper(['class' => 'form-group col-6']);
        CRUD::field('display_name')->wrapper(['class' => 'form-group col-6']);
        CRUD::field('separator')->type('separator');
        CRUD::field('phone');
        CRUD::field('email');
        CRUD::field('bank_name');
        CRUD::field('bank_account_name');
        CRUD::field('bank_account_number');
        CRUD::addField([   // Switch
            'name'  => 'switch',
            'type'  => 'switch',
            'label'    => 'Did you want to create user to this landlord?',

            // optional
            'color'    => 'success', // May be any bootstrap color class or an hex color
            'onLabel' => '✓',
            'offLabel' => '✕',
        ],);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
