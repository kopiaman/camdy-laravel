<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Faqs;
use App\Http\Requests\CreateFaqsRequest;
use App\Http\Requests\UpdateFaqsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\FaqCategories;


class FaqsController extends Controller {

	/**
	 * Display a listing of faqs
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $faqs = Faqs::with("faqcategories")->get();

		return view('admin.faqs.index', compact('faqs'));
	}

	/**
	 * Show the form for creating a new faqs
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $faqcategories = FaqCategories::lists("name", "id")->prepend('Please select', '');

	    
	    return view('admin.faqs.create', compact("faqcategories"));
	}

	/**
	 * Store a newly created faqs in storage.
	 *
     * @param CreateFaqsRequest|Request $request
	 */
	public function store(CreateFaqsRequest $request)
	{
	    $request = $this->saveFiles($request);
		Faqs::create($request->all());

		return redirect()->route('admin.faqs.index');
	}

	/**
	 * Show the form for editing the specified faqs.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$faqs = Faqs::find($id);
	    $faqcategories = FaqCategories::lists("name", "id")->prepend('Please select', '');

	    
		return view('admin.faqs.edit', compact('faqs', "faqcategories"));
	}

	/**
	 * Update the specified faqs in storage.
     * @param UpdateFaqsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFaqsRequest $request)
	{
		$faqs = Faqs::findOrFail($id);

        $request = $this->saveFiles($request);

		$faqs->update($request->all());

		return redirect()->route('admin.faqs.index');
	}

	/**
	 * Remove the specified faqs from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Faqs::destroy($id);

		return redirect()->route('admin.faqs.index');
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
            Faqs::destroy($toDelete);
        } else {
            Faqs::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.faqs.index');
    }

}
