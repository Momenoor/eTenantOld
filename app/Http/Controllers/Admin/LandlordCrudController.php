<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LandlordRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

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
        Widget::add()->type('script')->content(asset('assets/js/custom/create-user-switch.js'));
        CRUD::setValidation(LandlordRequest::class);
        CRUD::field('name')->size(6);
        CRUD::field('separator')->type('separator');
        CRUD::field('display_name')->size(6);
        CRUD::field('clearfix')->type('clearfix');
        CRUD::field('phone')->size(6);
        CRUD::field('email')->size(6);
        CRUD::field('bank_name')->size(4);
        CRUD::field('bank_account_name')->size(4);
        CRUD::field('bank_account_number')->size(4);
        CRUD::field('separator2')->type('separator');
        CRUD::addField([   // Switch
            'name'  => 'create_user_switch',
            'type'  => 'switch',
            'label'    => 'Did you want to create user to this landlord?',

            // optional
            'color'    => 'success', // May be any bootstrap color class or an hex color
            'onLabel' => '✓',
            'offLabel' => '✕',
        ],);
        CRUD::field('user.name')
            ->type('text')
            ->wrapper(['class' => 'form-group col-6 required'])
            ->label('Name');

        CRUD::field('user.email')
            ->type('text')
            ->wrapper(['class' => 'form-group col-6 required'])
            ->label('Email');



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
        CRUD::Field('create_user_switch')->remove();
        if ($this->crud->getCurrentEntry()->user) {
            CRUD::modifyField('user.name', [
                'attributes' => [
                    'class' => 'form-control-plaintext',
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
            ]);
            CRUD::modifyField('user.email', [
                'attributes' => [
                    'class' => 'form-control-plaintext',
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
            ]);
        } else {
            CRUD::field('user.name')->remove();
            CRUD::field('user.email')->remove();
            CRUD::field('separator2')->remove();
        }
    }
}
