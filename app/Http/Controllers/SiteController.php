<?php

namespace App\Http\Controllers;

use App\Color;
use App\Contact;
use App\Coupon;
use App\Models\Product;
use App\Order;
use App\OrderDetail;
use App\Page;
use Illuminate\Http\Request;
use App\Models\Cat;


class SiteController extends Controller
{

    //index
    public function index(){
        
        // return menu('site');
        return view('pages.index');
    }

    //category
    public function category($slug){
        $category = Cat::where('slug', $slug)->firstOrFail();
        return view('pages.category', compact('category'));
    }

    //page
    public function page($slug){
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('pages.page', compact('page'));
    }
    
    //search
    public function search(Request $request){
        
        if($request->isMethod('post')){
            
        }

        $products = Product::orderBy('created_at', 'desc')->take(5)->get();
        return view('pages.search', compact('products'));

    }
    //contact
    public function contact(Request $request){

        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
            ],
            [
                'name.required' => 'إدخل إسمك من فضلك',
                'email.required' => 'إدخل بريدك الألكتروني أو الموبيل من فضلك',
                'message.required' => 'إدخل رسالتك من فضلك',
            ]);

            $name = $request->name;
            $email = $request->email;
            $message = $request->message;

            $data = [
                'name' => $name,
                'email' => $email,
                'message' => $message
            ];
            
            $contact = new Contact();
            $contact->name = $name;
            $contact->email = $email;
            $contact->message = $message;
            $contact->save();

            return response()->json(['success' => true]);

        }

        return view('pages.contact');
    }

    //product
    public function product($slug){
        $product = Product::where('slug', $slug)->firstOrFail();
        // return $product;
        return view('pages.product', compact('product'));
    }

    //products
    public function products(Request $request){

        // if request is post
        if($request->isMethod('post')){

            $query = Product::query();

            if($request->ids){
                $query->whereIn('id', $request->ids);
            }

            if($request->search){
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
            }

            if($request->cat){
                $query->where('cat_id', $request->cat);
            }
    
            if($request->color){
                $query->whereHas('colors', function($q) use ($request){
                    $q->where('color_id', $request->color);
                });
            }
    
            if($request->size){
                $query->whereHas('sizes', function($q) use ($request){
                    $q->where('size_id', $request->size);
                });
            }
    
            if($request->price){
                $query->whereBetween('price', $request->price);
            }
    
            if($request->sort){
                if($request->sort == 'date_asc'){
                    $query->orderBy('created_at', 'asc');
                }
                if($request->sort == 'date_desc'){
                    $query->orderBy('created_at', 'desc');
                }
                if($request->sort == 'price_asc'){
                    $query->orderBy('price', 'asc');
                }
                if($request->sort == 'price_desc'){
                    $query->orderBy('price', 'desc');
                }
                if($request->sort == 'alph_asc'){
                    $query->orderBy('name', 'asc');
                }
                if($request->sort == 'alph_desc'){
                    $query->orderBy('name', 'desc');
                }
            }
    
            $products = $query->orderBy('created_at', 'desc')->paginate(env(key: 'PAGINATE'));
            return view('components.products', compact('products'));
        }

        
        return view('pages.products');


        

    }

    //qwickView
    public function quickView(Request $request){
        $product = Product::find($request->id);
        return view('components.quick', compact('product'));
    }


    //wishlist
    public function wishlist(){
        return view('pages.wishlist');
    }

    public function compare(){
        return view('pages.compare');
    }

    public function compareProducts(Request $request){
        $products = Product::whereIn('id', $request->ids)->get();
        return view('components.compare', compact('products'));
    }

    //test
    public function test(){
        $product = Product::find(2);
        return $product->colors;
    }


    //cart
    public function cart(){
        return view('pages.cart');
    }

    // check out
    public function checkout(){
        // egypt cities
        $governorates = [
            "القاهرة", 
            "الجيزة", 
            "القليوبية", 
            "الإسكندرية", 
            "البحيرة", 
            "مطروح", 
            "الدقهلية", 
            "كفر الشيخ", 
            "الغربية", 
            "المنوفية", 
            "الشرقية", 
            "الإسماعيلية", 
            "السويس", 
            "بورسعيد", 
            "شمال سيناء", 
            "جنوب سيناء", 
            "بني سويف", 
            "الفيوم", 
            "المنيا", 
            "أسيوط", 
            "الوادي الجديد", 
            "سوهاج", 
            "قنا", 
            "الأقصر", 
            "أسوان", 
            "البحر الأحمر"
        ];
        return view('pages.checkout', compact('governorates'));
    }

    //coupon
    public function coupon(Request $request){
        
        $request->validate([
            'coupon' => 'required'
        ]);

        $coupon = Coupon::where([
            ['code', $request->coupon],
            ['expiration_date' , '>', date('Y-m-d')]
        ])->first();
        if($coupon){

            return response()->json(['success' => true, 'data' => $coupon]);
        }
        return response()->json(['success' => false]);


    }

    //placeOrder
    public function placeOrder(Request $request){
        
        // save data in session
        $information = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address
        ];

        session()->put('information', $information);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cart' => 'required',
        ],[
            'first_name.required' => 'يرجى ادخال الاسم الاول',
            'last_name.required' => 'يرجى ادخال الاسم الاخير',
            'phone.required' => 'يرجى ادخال رقم الهاتف',
            'city.required' => 'يرجى إختيار المحافظة',
            'address.required' => 'يرجى ادخال العنوان',
            'cart.required' => 'يرجى اختيار المنتجات',
        ]);

        

        if(count($request->cart) == 0){
            return response()->json(['success' => false]);
        }

        $coupon = null;
        if($request->coupon){
            $coupon2 = Coupon::where([
                ['code', $request->coupon],
                ['expiration_date' , '>', date('Y-m-d')]
            ])->first();
            if($coupon2){
                $coupon = $coupon2;
            }
        }

        $invoice_code = $this->generateInvoiceCode();

        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->phone = $request->phone;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->notes = $request->notes;
        $order->invoice_code = $invoice_code;
        if($coupon != null){
            $order->coupon_details = json_encode($coupon);
        }
        
        $order->save();


        foreach($request->cart as $cart){
            $product = Product::find($cart['id']);
            if($product){
                $OrderDetail = new OrderDetail();
                $OrderDetail->order_id = $order->id;
                $OrderDetail->product_id = $cart['id'];
                $OrderDetail->color = $cart['color'];
                $OrderDetail->size = $cart['size'];
                $OrderDetail->quantity = $cart['count'];
                $OrderDetail->price = $product->final_price;
                $OrderDetail->save();
            }
        }

        return response()->json(['success' => true,
            'data' => $order
    ]);

    }

    private function generateInvoiceCode(){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        // Check if the generated code already exists in the database
        $existingCode = Order::where('invoice_code', $randomString)->first();
        if ($existingCode) {
            // Generate a new code if the existing code is found
            return $this->generateInvoiceCode();
        }
        return $randomString;
    }

    //invoice
    public function invoice($invoice_code){
        $order = Order::where('invoice_code', $invoice_code)->firstOrFail();
        return view('pages.invoice', compact('order'));
    }

}
