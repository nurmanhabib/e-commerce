<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Function to show all categories.
     */
    public function index()
    {
        $categories     = Category::orderBy('id', 'desc')->get();
        return [
            'status'        => 'success',
            'categories'    => $categories
        ];
    }

    /**
     * Function to save category
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required'
        ]);

        $category = $request->only(
            'name',
            'parent_id'
        );

        $category = Category::create($category);

        if ($category) { // if category successfully save
            return [
                'status'    => 'success',
                'message'   => 'Category '.$category->name.' successfully added.',
                'category'  => $category,
            ];
        } else {        // if category failed to be save
            return [
                'status'    => 'failed',
                'message'   => 'Category failed to be added.'
            ];
        }
    }

    /**
     * Function to show current category
     */
    public function show($id)
    {
        $category   = Category::find($id);

        if ($category) {    // if the category have been found
            return [
                'status'    => 'success',
                'category'  => $category
            ];
        } else {            // if the category is not found
            return [
                'status'    => 'failed',
                'message'   => 'Sorry, category you are looking for is does not exist.'
            ];
        }
    }

    public function childs($id) {
        $category = Categ
    }

    /**
     * Function to update category
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required'
        ]);

        $category   = Category::find($id);

        if ($category) {    // if category is found in database
            $category->name         = $request->input('name');
            $category->parent_id    = $request->input('parent_id');
            $category->slug         = $category->createSlug($request->input('name'));

            if ($category->save()) {    // if category has been successfully updated
                return [
                    'status'    => 'success',
                    'message'   => 'Category has been successfully updated.',
                    'category'  => $category
                ];
            } else {                    // if category has failed to be update
                return [
                    'status'    => 'failed',
                    'message'   => 'Category has failed to be update.'
                ];
            }
        } else {            // if category is not found in database
            return [
                'status'    => 'failed',
                'message'   => 'Category is not found.'
            ];
        }
    }

    /**
     * Function to delete category
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {    // if category is found in database
            $childCategory = Category::where('parent_id', '=', $id)->delete();

            if ($category->delete()) {  // if category has been successfully deleted
                return [
                    'status'    => 'success',
                    'message'   => 'Category has been successfully deleted.'
                ];
            } else {                    // if category has failed to be delete
                return [
                    'status'    => 'failed',
                    'message'   => 'Category has failed to be delete.'
                ];
            }
        } else {            // if category is not found in database
            return [
                'status'    => 'failed',
                'message'   => 'Category is not found.'
            ];
        }
    }
}