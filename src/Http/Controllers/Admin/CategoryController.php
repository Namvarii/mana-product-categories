<?php

    namespace ManaCMS\ManaProductCategories\Http\Controllers\Admin;

    use Illuminate\Support\Facades\Validator;
    use ManaCMS\ManaProductCategories\Http\Controllers\Controller;
    use ManaCMS\ManaProductCategories\Http\Requests\StoreProductCategory;
    use ManaCMS\ManaProductCategories\Models\ProductCategorizable;
    use ManaCMS\ManaProductCategories\Models\ProductCategory;
    use Illuminate\Http\Request;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories = ProductCategory::whereNull('parent_id')->with('moreChilds')->get()->keyBy('id');
            return view('categories::admin.index',compact('categories'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $categories = ProductCategory::whereNull('parent_id')->with('moreChilds')->get()->keyBy('id');
            return view('categories::admin.create',compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(StoreProductCategory $request)
        {

            if ($request->parent == 'noparent') {
                list($request->parent, $request->level) = [null,0];
            }
            else {
                list($request->parent, $request->level) = explode('#',$request->parent);
                $request->level += 1;
            }
            ProductCategory::create([
                'level' => $request->level,
                'parent_id' => $request->parent,
                'slug' => $request->slug,
                'title' => $request->title,
                'desc' => $request->description,
            ]);
            return redirect()->route('manage.category.index')->with('success',"دسته بندی «{$request->title}» با موفقیت ایجاد شد.")->with('title','تبریک!');

        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\Response
         */
        public function show(ProductCategory $category)
        {
            //
            return 'show@CategoryController';
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\Response
         */
        public function edit(ProductCategory $category)
        {
            $categories = ProductCategory::whereNull('parent_id')->with('childs.childs')->get()->keyBy('id');
            return view('categories::admin.create',compact('category','categories'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(StoreProductCategory $request, ProductCategory $category)
        {
            $request->validate([
                'title' => 'required|string|max:191',
                'title_en' => 'required|string|max:191',
                'slug' => 'required|string|max:50',
                'expert' => 'nullable|string',
                'expert_en' => 'nullable|string',
            ]);

            $category->title = $request->title;
            $category->title_en = $request->title_en;
            $category->slug = $request->slug;
            $category->expert = $request->expert;
            $category->expert_en = $request->expert_en;
            $category->save();
            return redirect()->route('manage.category.index')->with('success',"دسته بندی «{$request->title}» با موفقیت بروزرسانی شد.")->with('title','تبریک!');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(ProductCategory $category)
        {
            ProductCategorizable::where('category_id',$category->id)->delete();
            $category->delete();
            return back()->with('success',"دسته بندی «{$category->title}» با موفقیت حذف شد.")->with('title','حذف موفقیت آمیز!');
        }
    }
