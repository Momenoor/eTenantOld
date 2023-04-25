<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContractRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContractCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContractCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Contract::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contract');
        CRUD::setEntityNameStrings('contract', 'contracts');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('number');
        CRUD::column('property_id');
        CRUD::column('type_id');
        CRUD::column('status_id');
        CRUD::column('start_at');
        CRUD::column('expire_at');
        CRUD::column('grace_start_at');
        CRUD::column('grace_expire_at');
        CRUD::column('annual_value');
        CRUD::column('value');
        CRUD::column('discount');
        CRUD::column('atesting_document_number');
        CRUD::column('remarks');
        CRUD::column('conditions');

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
        CRUD::setValidation(ContractRequest::class);

        CRUD::field('number');
        CRUD::field('property_id');
        CRUD::field('type_id');
        CRUD::field('status_id');
        CRUD::field('start_at');
        CRUD::field('expire_at');
        CRUD::field('grace_start_at');
        CRUD::field('grace_expire_at');
        CRUD::field('annual_value');
        CRUD::field('value');
        CRUD::field('discount');
        CRUD::field('atesting_document_number');
        CRUD::field('remarks');
        CRUD::field('conditions');

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
