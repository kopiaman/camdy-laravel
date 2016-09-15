<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Blogs;
use App\Http\Requests\CreateBlogsRequest;
use App\Http\Requests\UpdateBlogsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\BlogCategories;


class BlogsController extends Controller {

	/**
	 * Display a listing of blogs
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $blogs = Blogs::with("blogcategories")->get();

		return view('admin.blogs.index', compact('blogs'));
	}

	/**
	 * Show the form for creating a new blogs
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $blogcategories = BlogCategories::lists("name", "id")->prepend('Please select', '');

	    
	    return view('admin.blogs.create', compact("blogcategories"));
	}

	/**
	 * Store a newly created blogs in storage.
	 *
     * @param CreateBlogsRequest|Request $request
	 */
	public function store(CreateBlogsRequest $request)
	{
	    $request = $this->saveFiles($request);
		Blogs::create($request->all());

		return redirect()->route('admin.blogs.index');
	}

	/**
	 * Show the form for editing the specified blogs.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$blogs = Blogs::find($id);
	    $blogcategories = BlogCategories::lists("name", "id")->prepend('Please select', '');

	    
		return view('admin.blogs.edit', compact('blogs', "blogcategories"));
	}

	/**
	 * Update the specified blogs in storage.
     * @param UpdateBlogsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBlogsRequest $request)
	{
		$blogs = Blogs::findOrFail($id);

        $request = $this->saveFiles($request);

		$blogs->update($request->all());

		return redirect()->route('admin.blogs.index');
	}

	/**
	 * Remove the specified blogs from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Blogs::destroy($id);

		return redirect()->route('admin.blogs.index');
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
            Blogs::destroy($toDelete);
        } else {
            Blogs::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.blogs.index');
    }

}
