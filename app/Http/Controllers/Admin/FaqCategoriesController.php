<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\FaqCategories;
use App\Http\Requests\CreateFaqCategoriesRequest;
use App\Http\Requests\UpdateFaqCategoriesRequest;
use Illuminate\Http\Request;



class FaqCategoriesController extends Controller {

	/**
	 * Display a listing of faqcategories
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $faqcategories = FaqCategories::all();

		return view('admin.faqcategories.index', compact('faqcategories'));
	}

	/**
	 * Show the form for creating a new faqcategories
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.faqcategories.create');
	}

	/**
	 * Store a newly created faqcategories in storage.
	 *
     * @param CreateFaqCategoriesRequest|Request $request
	 */
	public function store(CreateFaqCategoriesRequest $request)
	{
	    
		FaqCategories::create($request->all());

		return redirect()->route('admin.faqcategories.index');
	}

	/**
	 * Show the form for editing the specified faqcategories.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$faqcategories = FaqCategories::find($id);
	    
	    
		return view('admin.faqcategories.edit', compact('faqcategories'));
	}

	/**
	 * Update the specified faqcategories in storage.
     * @param UpdateFaqCategoriesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFaqCategoriesRequest $request)
	{
		$faqcategories = FaqCategories::findOrFail($id);

        

		$faqcategories->update($request->all());

		return redirect()->route('admin.faqcategories.index');
	}

	/**
	 * Remove the specified faqcategories from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		FaqCategories::destroy($id);

		return redirect()->route('admin.faqcategories.index');
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
            FaqCategories::destroy($toDelete);
        } else {
            FaqCategories::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.faqcategories.index');
    }

}
