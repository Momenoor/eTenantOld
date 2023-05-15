<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PropertyRequest;
use App\Models\Landlord;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class PropertyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PropertyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $relatedEnitny;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Property::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/property');
        CRUD::setEntityNameStrings('property', 'properties');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('landlord');
        CRUD::column('code');
        CRUD::column('name');
        CRUD::column('floor_count');
        CRUD::column('makani');
        CRUD::column('premises');
        CRUD::column('condition');
        CRUD::column('address');
        CRUD::column('emirate');
        CRUD::column('description');
        CRUD::column('type');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::setValidation(PropertyRequest::class);


        CRUD::field('landlord');
        CRUD::field('type')->options(
            (function ($query) {
                return $query->property()->get();
            }),
        )->size(6);
        CRUD::field('fix')->type('clearfix');
        CRUD::field('code')->size(3);
        CRUD::field('name')->size(6);
        CRUD::field('fix1')->type('clearfix');
        CRUD::field('floor_count')->type('dialer')->size(2);
        CRUD::field('makani')->size(3);
        CRUD::field('premises')->size(3);
        CRUD::field('description')->size(8);
        CRUD::field('condition')->size(8);

        CRUD::field('emirate')->type('select2_from_array')->options(
            [
                'Dubai' => 'Dubai',
                'Abu Dhabi' => 'Abu Dhabi',
                'Sharjah' => 'Sharjah',
                'Ajman' => 'Ajman',
                'Umm Al Quwain' => 'Umm Al Quwain',
                'Ras Al Khaimah' => 'Ras Al Khaimah',
                'Fujairah' => 'Fujairah',
            ]
        )->size(6);
        CRUD::field('address')->size(8);




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

    public function createFromLandlord(Landlord $landlord)
    {
        CRUD::modifyField('landlord', ['type' => 'hidden', 'value' => $landlord->id]);
        $this->data['crud'] = $this->crud;
        $this->data['related'] = $landlord;
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.add') . ' ' . $this->crud->entity_name;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::related_create', $this->data);
    }
}
