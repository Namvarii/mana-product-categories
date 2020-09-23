<?php

    namespace ManaCMS\ManaProductCategories\Http\Controllers\Admin;

    use Illuminate\Support\Facades\Validator;
    use ManaCMS\ManaProductCategories\Http\Controllers\Controller;
    use ManaCMS\ManaProductCategories\Http\Requests\StoreProductCategory;
    use ManaCMS\ManaProductCategories\Models\ProductCategorizable;
    use ManaCMS\ManaProductCategories\Models\ProductCategory;
    use Illuminate\Http\Request;

    class ProductCategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories = ProductCategory::whereNull('parent_id')->with('moreChilds')->get()->keyBy('id');
            return view('ProductCategories::admin.index',compact('categories'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $categories = ProductCategory::whereNull('parent_id')->with('moreChilds')->get()->keyBy('id');
            return view('ProductCategories::admin.create',compact('categories'));
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
            return redirect()->route('manage.productcategory.index')->with('success',"دسته بندی «{$request->title}» با موفقیت ایجاد شد.")->with('title','تبریک!');

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
        public function edit($productCategory)
        {
            $category = ProductCategory::whereSlug($productCategory)->first();
            $categories = ProductCategory::whereNull('parent_id')->with('moreChilds')->get()->keyBy('id');
            $categories = $categories->except($category->id);
            return view('ProductCategories::admin.create',compact('category','categories'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(StoreProductCategory $request, $productCategory)
        {
            $request = json_decode(json_encode($request->validated()));
            $category = ProductCategory::whereSlug($productCategory)->first();
            if ($request->parent == 'noparent') {
                list($request->parent, $request->level) = [null,0];
            }
            else {
                list($request->parent, $request->level) = explode('#',$request->parent);
                $request->level += 1;
            }

            $category->title = $request->title;
            $category->parent_id = $request->parent;
            $category->level = $request->level;
            $category->slug = $request->slug;
            $category->desc = $request->description;
            if ($category->isDirty()) {
                $category->save();
                return redirect()->route('manage.productcategory.index')->with('success',"دسته بندی «{$request->title}» با موفقیت بروزرسانی شد.")->with('title','تبریک!');
            }
            return redirect()->route('manage.productcategory.index')
                ->with([
                    'title'=>'متاسفیم!',
                    'error'=>"دسته بندی «{$request->title}» با موفقیت بروزرسانی نشد و چیزی برای بروزرسانی وجود نداشت.",
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Category  $category
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy($productCategory)
        {
            $category = ProductCategory::whereSlug($productCategory)->first();
            ProductCategorizable::where('product_category_id',$category->id)->delete();
            $category->delete();
            return back()->with('success',"دسته بندی «{$category->title}» با موفقیت حذف شد.")->with('title','حذف موفقیت آمیز!');
        }
    }
