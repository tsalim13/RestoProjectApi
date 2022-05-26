<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Category;

class CategoryAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        //sleep(3);

        return $this->sendResponse($categories->toArray(), "success");
    }

    public function categorywithcount()
    {
        $categories = Category::withCount('products')->orderBy('order', 'ASC')->get();
        //sleep(3);
        return $this->sendResponse($categories->toArray(), "success");
    }

    public function categoriestree()
    {
        $categories = Category::whereNull('parent_id')->with('subCategoryTree')->withCount(['products' => function ($query) {
            $query->where('available', 1);
        }])->get();
        //sleep(3);
        return $this->sendResponse($categories->toArray(), "success");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $category = Category::create(json_decode($input['category'], true));
            if ($category) {
                if ($request->hasFile('image')) {
                    $category->addMediaFromRequest('image')->toMediaCollection('Categories');
                }
                $categories = Category::whereNull('parent_id')->with('subCategoryTree')->get();
                return $this->sendResponse($categories, "category api success");
            }
            return $this->sendError("category api error");
        } catch (\Exception $e) {
            Log::error($e);
            return $this->sendError("category api error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $this->sendResponse($category, "category api success");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
