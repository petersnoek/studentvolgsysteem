<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GroupCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Group::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/group');
        CRUD::setEntityNameStrings('group', 'groups');

        $groups = Group::select('code')->distinct()->get();
        $groups->isEmpty() ? '' :
        $this->crud->addFilter([
            'name'  => 'Classcode',
            'type'  => 'dropdown',
            'label' => 'Classcode'
        ], [
            $groups
        ], function($value) { // if the filter is active
            $this->crud->addClause('where', 'code', $value);
        });
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('code');
        CRUD::column('created_at');
        CRUD::column('description');
        CRUD::column('id');
        CRUD::column('updated_at');

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
        CRUD::setValidation(GroupRequest::class);

        CRUD::field('code');
        //CRUD::field('created_at');
        CRUD::field('description');
        //CRUD::field('id');
        //CRUD::field('updated_at');

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Students",
            'type' => 'select2_multiple',
            'name' => 'students', // the method that defines the relationship in your Model
            'entity' => 'students', // the method that defines the relationship in your Model
            'attribute' => 'firstname', // foreign key attribute that is shown to user
            'model' => "App\Models\Student", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'select_all' => true,
        ]);


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
