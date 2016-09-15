<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BlogCategories;
use App\Http\Requests\CreateBlogCategoriesRequest;
use App\Http\Requests\UpdateBlogCategoriesRequest;
use Illuminate\Http\Request;



class BlogCategoriesController extends Controller {

	/**
	 * Display a listing of blogcategories
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $blogcategories = BlogCategories::all();

		return view('admin.blogcategories.index', compact('blogcategories'));
	}

	/**
	 * Show the form for creating a new blogcategories
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.blogcategories.create');
	}

	/**
	 * Store a newly created blogcategories in storage.
	 *
     * @param CreateBlogCategoriesRequest|Request $request
	 */
	public function store(CreateBlogCategoriesRequest $request)
	{
	    
		BlogCategories::create($request->all());

		return redirect()->route('admin.blogcategories.index');
	}

	/**
	 * Show the form for editing the specified blogcategories.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$blogcategories = BlogCategories::find($id);
	    
	    
		return view('admin.blogcategories.edit', compact('blogcategories'));
	}

	/**
	 * Update the specified blogcategories in storage.
     * @param UpdateBlogCategoriesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBlogCategoriesRequest $request)
	{
		$blogcategories = BlogCategories::findOrFail($id);

        

		$blogcategories->update($request->all());

		return redirect()->route('admin.blogcategories.index');
	}

	/**
	 * Remove the specified blogcategories from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		BlogCategories::destroy($id);

		return redirect()->route('admin.blogcategories.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            BlogCategories::destroy($toDelete);
        } else {
            BlogCategories::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.blogcategories.index');
    }

}
