<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        // Creates object with no adding to DB
//        $item = new BlogCategory($data);
//
//        $item->save();

        $item = (new BlogCategory())->create($data);


        //   dd($item);

        if ($item) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено'])
                ->withInput();
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        $item = $categoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $categoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'description' => 'string|max:500|min:5',
//            'parent_id' => 'required|integer|exists:blog_categories,id',
//        ];
//
//        $validator = \Validator::make($request->all(), $rules);
//
//        $validatedData[] = $validator->passes();
//        $validatedData[] = $validator->valid();
//        $validatedData[] = $validator->failed();
//        $validatedData[] = $validator->errors();
//        $validatedData[] = $validator->fails();
//
//        dd($validatedData);
//        $validatedData = $this->validate($request, $rules);
//
//       // dd($validatedData);

        $item = BlogCategory::find($id);
        //dd($item);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись с id=[" . $id . "] не найдена "])
                ->withInput();
        }

        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

}
