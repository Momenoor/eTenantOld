<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait ShowTableInRelatedFormOperation
{

    protected $willCreate;
    protected $ButtonIcon;

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupShowTableInRelatedFormRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{related}/show-table-in-related-form', [
            'as'        => $routeName . '.showTableInRelatedForm',
            'uses'      => $controller . '@showTableInRelatedForm',
            'operation' => 'show',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupShowTableInRelatedFormDefaults()
    {

        CRUD::operation('show', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();

        });

        CRUD::operation('list', function () {
            CRUD::set('list.related', $this->willCreate);
            CRUD::set('list.icon', $this->ButtonIcon);
            CRUD::addButton('line', 'addRelated', 'view', 'crud::buttons.add_related', 'beginning');

        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showTableInRelatedForm($related)
    {
        CRUD::hasAccessOrFail('show');
        $related = $this->crud->getEntry($related);
        $this->data['entry'] = $related;
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.preview') . ' ' . $this->crud->entity_name;
        $this->crud->removeAllButtons();

        // load the view
        return view('crud::show_table', $this->data);
    }
}
