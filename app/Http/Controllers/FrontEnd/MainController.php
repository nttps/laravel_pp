<?php

namespace NttpDev\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Product;
use NttpDev\Model\Category;
use NttpDev\Model\Brand;
use NttpDev\Model\Article;
use NttpDev\Model\CategoryArticle;
use NttpDev\Model\TagArticle;
use NttpDev\Model\Content;
use Cart;
use NttpDev\User;
use DB;
use NttpDev\Model\Widget;
use NttpDev\Model\Order;
use NttpDev\Model\OrderProduct;
use NttpDev\Model\ShippingZone;
use NttpDev\Model\ShippingZoneValue;
use Illuminate\Support\Facades\Mail;
use NttpDev\Model\Bank;

class MainController extends Controller
{



    public function testpayment()
    {

        return view('frontend.testpay');
    }
    /**
     * Home Landing Page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        $categories = Category::with('products')->where('enable_home', 1)->orderBy('sort', 'ASC')->get();

        $categorie_banners = Category::with('products')->where('enable_banner', 1)->orderBy('sort', 'ASC')->take(9)->get();
        $brands  =   Brand::all();
        $banners =  Widget::where('widget_type', 'banner')->take(3)->get();
        $slides =  Widget::where('widget_type', 'slide')->get();
        $articles = Article::take(8)->get();
        $products_seller = Product::where('is_sales', 1)->where('is_show', 1)->get();
        $products_banner = Product::where('is_banner', 1)->where('is_show', 1)->take(3)->get();
        $seller_left_1 = Widget::where('code', 'seller_left_1')->first();
        $product_left_1 = Product::find($seller_left_1->url_link);
        $seller_left_2 = Widget::where('code', 'seller_left_2')->first();
        $product_left_2 = Product::find($seller_left_2->url_link);
        $seller_left_3 = Widget::where('code', 'seller_left_3')->first();
        $product_left_3 = Product::find($seller_left_3->url_link);
        $seller_right_1 = Widget::where('code', 'seller_right_1')->first();
        $product_right_1 = Product::find($seller_right_1->url_link);
        $seller_right_2 = Widget::where('code', 'seller_right_2')->first();
        $product_right_2 = Product::find($seller_right_2->url_link);
        $seller_right_3 = Widget::where('code', 'seller_right_3')->first();
        $product_right_3 = Product::find($seller_right_3->url_link);

        //dd($categories);
        return view('frontend.home', compact(
            'products_banner',
            'categorie_banners',
            'categories',
            'brands',
            'banners',
            'slides',
            'articles',
            'products_seller',
            'seller_left_1',
            'seller_left_2',
            'seller_left_3',
            'seller_right_1',
            'seller_right_2',
            'seller_right_3',
            'product_left_1',
            'product_left_2',
            'product_left_3',
            'product_right_1',
            'product_right_2',
            'product_right_3'
        ));
    }

    /**
     * Home Landing Page
     *
     * @return \Illuminate\Http\Response
     */
    public function homeDev()
    {
        return view('frontend.dev_home');
    }
    /**
     * All Product
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $column = 'created_at';
        $sort   = 'DESC';

        if (request()->get('sort') == 'price_asc') {
            $column = 'discount_price - price';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'price_desc') {
            $column = 'discount_price - price';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'name_asc') {
            $column = 'name';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'name_desc') {
            $column = 'name';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'newest') {
            $column = 'created_at';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'oldest') {
            $column = 'created_at';
            $sort   = 'ASC';
        }

        $products = Product::query();

        //SET PRODUCTS

        if (!empty(request()->category)) {
            $products = $products->with('categories')->whereHas('categories', function ($query) {
                $query->whereIn('slug', request()->category);
            });
        }

        if (!empty(request()->brands)) {
            $products = $products->with('brands')->whereHas('brands', function ($query) {
                $query->WhereIn('slug', request()->brands);
            });
        }



        $products = $products->where('product_type', '=', 'product')->where('is_show', 1);
        if (request()->get('sort') == 'price_asc') {
            $products = $products->orderByRaw("discount_price -price DESC")->get();
        } elseif (request()->get('sort') == 'price_desc') {

            $products = $products->orderByRaw("discount_price - price ASC")->get();
        } else {
            $products = $products->orderBy($column, $sort)->get();
        }
        $brands = Brand::all();
        return view('frontend.products.index', compact('products', 'brands'));
    }

    /**
     * Show Product
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->firstOrfail();
        $attributes_product = $product->attributes()->get();
        $relateForProduct = $product->relateProduct()->get();
        $optionsForProduct =     $product->options()->whereNull('parent_id')->orderBy('created_at', 'ASC')->get();
        $options_product = $product->attributes()->where('is_option', 1)->get();
        $countVariant = $product->variants()->count();
        $images = json_decode($product->images);

        return view('frontend.products.show', compact('product', 'images', 'attributes_product', 'relateForProduct', 'optionsForProduct', 'countVariant'));
    }

    /**
     * All categories
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {

        $categories  =   Category::orderBy('sort', 'ASC')->get();
        return view('frontend.categories.index', compact('categories'));
    }
    /**
     * All categories
     *
     * @return \Illuminate\Http\Response
     */
    public function categoriesShow($slug)
    {
        $column = 'created_at';
        $sort   = 'DESC';

        if (request()->get('sort') == 'price_asc') {
            $column = 'discount_price - price';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'price_desc') {
            $column = 'discount_price - price';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'name_asc') {
            $column = 'name';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'name_desc') {
            $column = 'name';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'newest') {
            $column = 'created_at';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'oldest') {
            $column = 'created_at';
            $sort   = 'ASC';
        }

        $categories = explode('/', $slug);
        $category = Category::where('slug', end($categories))->first();


        $products = Product::with('categories')->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category->slug);
        });
        $products = $products->where('product_type', '=', 'product')->where('is_show', 1);


        if (request()->get('sort') == 'price_asc') {

            $products = $products->orderByRaw("discount_price -price DESC")->get();
        } elseif (request()->get('sort') == 'price_desc') {


            $products = $products->orderByRaw("discount_price - price ASC")->get();
        } else {

            $products = $products->orderBy($column, $sort)->get();
        }

        return view('frontend.categories.show', compact('products', 'category'));
    }

    /**
     * All Brands
     *
     * @return \Illuminate\Http\Response
     */
    public function brands()
    {
        $brands  =   Brand::all();
        return view('frontend.brands.index', compact('brands'));
    }
    /**
     * All categories
     *
     * @return \Illuminate\Http\Response
     */
    public function brandsShow($slug)
    {

        $column = 'created_at';
        $sort   = 'DESC';

        if (request()->get('sort') == 'price_asc') {
            $column = 'discount_price - price';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'price_desc') {
            $column = 'discount_price - price';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'name_asc') {
            $column = 'name';
            $sort   = 'ASC';
        }
        if (request()->get('sort') == 'name_desc') {
            $column = 'name';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'newest') {
            $column = 'created_at';
            $sort   = 'DESC';
        }
        if (request()->get('sort') == 'oldest') {
            $column = 'created_at';
            $sort   = 'ASC';
        }

        $products = Product::with('brands')->whereHas('brands', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });

        $products = $products->where('product_type', '=', 'product')->where('is_show', 1);
        if (request()->get('sort') == 'price_asc') {

            $products = $products->orderByRaw("discount_price -price DESC")->get();
        } elseif (request()->get('sort') == 'price_desc') {


            $products = $products->orderByRaw("discount_price - price ASC")->get();
        } else {
            $products = $products->orderBy($column, $sort)->get();
        }
        $brand     = Brand::where('slug', $slug)->first();
        return view('frontend.brands.show', compact('products', 'brand'));
    }

    /**
     * Contact Page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $content = Content::where('code', 'contact_index')->firstOrfail();
        return view('frontend.contact', compact('content'));
    }
    /**
     * Contact Post From
     *
     * @return \Illuminate\Http\Response
     */
    public function contactPost(Request $request)
    {
        //dd($request);

        $data = array(
            'name'  => $request->name,
            'surname'  => $request->surname,
            'address'  => $request->address,
            'telephone'  => $request->telephone,
            'email'  => $request->email,
            'description'  => $request->description,
            'contact_by'  => $request->contact_by
        );
        Mail::send('emails.contact.contact', $data, function ($message) {
            $message->from('sales@nttps.com', 'TGOBAL');
            $message->to(getSetting($value = 'admininstrator_email'))->subject(' มีข้อความติดต่อมาจาก TGOBAL');
        });
        return redirect()->back();
    }

    /**
     * All knowledge
     *
     * @return \Illuminate\Http\Response
     */
    public function knowledge()
    {
        $articles = Article::all();
        return view('frontend.knowledge.index', compact('articles', 'tagsForData'));
    }
    /**
     * knowledge Show
     *
     * @return \Illuminate\Http\Response
     */
    public function knowledgeShow($slug)
    {
        $article    =       Article::where('slug', $slug)->firstOrfail();
        $categories =       CategoryArticle::all();
        $tags       =       TagArticle::all();
        return view('frontend.knowledge.show', compact('article', 'categories', 'tags'));
    }
    /**
     * knowledge Tag
     *
     * @return \Illuminate\Http\Response
     */
    public function knowledgeTag($slug)
    {
        $articles = Article::with('tags')->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
        $tagName =   TagArticle::where('slug', $slug)->first()->name;
        return view('frontend.knowledge.tag', compact('articles', 'tagName'));
    }
    /**
     * knowledge Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function knowledgeCate($slug)
    {
        $articles = Article::with('categories')->whereHas('categories', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
        $CateName =   CategoryArticle::where('slug', $slug)->first()->name;
        return view('frontend.knowledge.category', compact('articles', 'CateName'));
    }
    /**
     * All categories
     *
     * @return \Illuminate\Http\Response
     */
    public function promotion()
    {
        $promotions = Content::where('type', 'promotion')->get();
        return view('frontend.promotion.index', compact('promotions'));
    }

    /**
     * All categories
     *
     * @return \Illuminate\Http\Response
     */
    public function promotionShow($slug)
    {
        $promotion = Content::where('slug', $slug)->firstOrFail();
        return view('frontend.promotion.show', compact('promotion'));
    }

    /**
     * Cart
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {

        if (auth()->user()->active == 0) {
            return redirect()
                ->route('confirm_number');
        }
        $cartCollection = Cart::getContent();
        $sort = $cartCollection->sort();
        $totals = Cart::getTotal();
        return view('frontend.cart', compact('sort', 'totals'));
    }




    public function thankyou($id)
    {
        $order = Order::find($id);
        $banks = Bank::all();
        return view('frontend.thankyou', compact('order', 'banks'));
    }
    /**
     * Term & Privacy
     *
     * @return \Illuminate\Http\Response
     */
    public function contentTerm($slug)
    {
        $content = Content::where('slug', $slug)->firstOrfail();
        return view('frontend.term', compact('content'));
    }

    /**
     * Term & Privacy
     *
     * @return \Illuminate\Http\Response
     */
    public function contentAbout($slug)
    {
        $content = Content::where('slug', $slug)->firstOrfail();
        return view('frontend.about', compact('content'));
    }
    /**
     * Term & Privacy
     *
     * @return \Illuminate\Http\Response
     */
    public function About()
    {
        $content = Content::where('code', 'about_index')->firstOrfail();
        return view('frontend.about', compact('content'));
    }

    /**
     * Helps Center
     *
     * @return \Illuminate\Http\Response
     */
    public function contentHelp($slug)
    {
        $content = Content::where('slug', $slug)->firstOrfail();
        return view('frontend.help', compact('content'));
    }

    /**
     * Helps Center
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {


        if ($request->search) {

            $output = '<div>';

            $products = Product::where('name', 'LIKE', '%' . $request->search . "%")->whereNull('product_parent')->get();
            $brands = Brand::where('name', 'LIKE', '%' . $request->search . "%")->get();
            $categories = Category::where('name', 'LIKE', '%' . $request->search . "%")->get();


            if ($products->count() > 0 or $brands->count() > 0 or $categories->count() > 0) {

                if ($products->count() > 0) {
                    $output .= '<p class="mb-1"><em>สินค้า</em></p>';
                    foreach ($products as $key => $product) {


                        $output .= '<a class="d-block" href="' . route('products.show', [$product->slug]) . '">' .
                            '<b>' . $product->name . '</b>' .
                            '</a>';
                    }
                }
                if ($brands->count() > 0) {
                    $output .= '<p class="mb-1"><em>แบรนด์</em></p>';
                    foreach ($brands as $key => $brand) {

                        $output .= '<a class="d-block" href="' . route('brands.show', [$brand->slug]) . '">' .
                            '<b>' . $brand->name . '</b>' .
                            '</a>';
                    }
                }

                if ($categories->count() > 0) {
                    $output .= '<p class="mb-1"><em>หมวดหมู่สินค้า</em></p>';
                    foreach ($categories as $key => $category) {


                        if ($category->parent()->count() > 0) {
                            $output .= '<a class="d-block" href="' . route('categories.show', [$category->getUrlSlugParent()]) . '">' .
                                '<b>' . $category->name . '</b>' .
                                '</a>';
                        } else {
                            $output .= '<a class="d-block" href="' . route('categories.show', [$category->slug]) . '">' .
                                '<b>' . $category->name . '</b>' .
                                '</a>';
                        }
                    }
                }

                $output .=  '</div>';
                return response($output);
            } else {
                $output .=  '<p class="mb-1">ไม่พบคำที่ค้นหา</p> ';
                return response($output);
            }
        } else {
            $products = Product::query();

            //SET PRODUCTS

            if (!empty(request()->category)) {
                $products = $products->with('categories')->whereHas('categories', function ($query) {
                    $query->whereIn('slug', request()->category);
                });
            }

            if (!empty(request()->brands)) {
                $products = $products->with('brands')->whereHas('brands', function ($query) {
                    $query->WhereIn('slug', request()->brands);
                });
            }
            $products = $products->where('name', 'LIKE', '%' . $request->q . "%")->whereNull('product_parent')->get();
            $brands = Brand::all();
            return view('frontend.products.index', compact('products', 'brands'));
        }
    }


    public function switchLang($lang)
    {
        if (array_key_exists($lang, config()->get('languages'))) {
            session()->put('applocale', $lang);
        }
        return redirect()->back();
    }
}
