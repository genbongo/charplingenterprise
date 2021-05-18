<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Google\Cloud\Storage\StorageClient;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_role == 1){
            return redirect('/main');
        } else {
            return view('admin.home');

        }
    }

    /*
    * Create a function that will navigate the user to profile page
    */
    public function profile()
    {
        return view('profile.index');
    }

    /*
    * Create a function that will upload a profile picture
    */
    public function profile_upload(Request $request)
    {
        //check if there is an ajax request
        if($request->ajax()){
            $validation = Validator::make($request->all(), [
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);

            if($validation->passes())
            {
                // $image = $request->file('img');
                // $path = \Storage::disk('public')->put('img/profile', $image);
            
                // #start here ============================================================
                // $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
                
                // $storage = new StorageClient([
                //     'keyFile' => json_decode($googleConfigFile, true)
                // ]);

                // $storageBucketName  = config('googlecloud.storage_bucket');
                // $bucket             = $storage->bucket($storageBucketName);
                // $fileSource         = fopen(storage_path('app/public/'.$path), 'r');
                
                // $googleCloudStoragePath = $path;

                // $bucket->upload($fileSource, [
                //     'predefinedAcl'  => 'publicRead',
                //     'name'           => $googleCloudStoragePath
                // ]);
                // #end here ===============================================================
                // $new_name = str_replace("img/profile/", "", $path);
                $image = $request->file('img');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/profile'), $new_name);

                User::updateOrCreate([
                    'id' => $request->user_id
                ],[
                    'img' => $new_name,
                ]);

                
                return response()->json([
                    'message'   => 'Image Upload Successfully',
                    'uploaded_image' => url('img/profile').'/'.$new_name, //'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/profile/' . $new_name
                ]);
            }
            else
            {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                ]);
            }
        }
        
    }

    /*
    * Create a function that will update a profile
    */
    public function profile_update(Request $request)
    {
        if($request->email != $request->email1){
            if(User::where('email', $request->email)->first()){
                return response()->json([
                    'status'    => 'exist',
                    'message'   => 'Email Address Already Exist.'
                ]);
            } else {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],[
                    'fname' => $request->fname,
                    'mname' => $request->mname,
                    'lname' => $request->lname,
                    'address' => $request->address,
                    'contact_num' => $request->contact_num,
                    'email' => $request->email
                ]);
            }
        }  else if($request->contact_num != $request->contact_num1) { 
            if(User::where('contact_num', $request->contact_num)->first()){
                return response()->json([
                    'status'    => 'exist',
                    'message'   => 'Phone Number Already Exist.'
                ]);
            } else {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],[
                    'fname' => $request->fname,
                    'mname' => $request->mname,
                    'lname' => $request->lname,
                    'address' => $request->address,
                    'contact_num' => $request->contact_num,
                    'email' => $request->email
                ]);
            }
        } else {
            User::updateOrCreate([
                'id' => $request->user_id
            ],[
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'address' => $request->address,
                'contact_num' => $request->contact_num,
                'email' => $request->email
            ]);
        }
    
        return response()->json([
            'status'    => 'success',
            'message'   => 'Profile Successfully Updated!',
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'contact_num' => $request->contact_num,
            'email' => $request->email
        ]);
    }

    /*
    * Create a function that will reset a password
    */
    public function profile_pass_reset(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm' => ['same:password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

        return response()->json([
            'message'   => 'Password Successfuly Changed',
        ]);
    }

    /*
    * Create a function display the count of Orders to deliver
    */
    public function display_order_to_deliver_count(){
        $getOrderToDeliverCount = Order::join('order_invoice',  ['orders.invoice_id' => 'order_invoice.id'])
            ->where('is_approved',1)
                ->where('delivery_date', '=', date('Y-m-d'))
                    ->groupBy('orders.invoice_id')    
                        ->get()
                            ->count();

        return response()->json([
            'count'   => $getOrderToDeliverCount,
            'status'  => 200
        ]);
    }

    /*
    * Create a function display the count of Orders to approve
    */
    public function display_order_to_approve_count(){
        // if(env("DB_CONNECTION") == "pgsql"){
        //     $getOrderToApproveCount = DB::select("SELECT COUNT(*) as data FROM orders WHERE is_approved = '0'");
        // }else{
        //     $getOrderToApproveCount = DB::select('SELECT COUNT(*) as data FROM orders WHERE is_approved = 0');
        // }
        
        // return response()->json([
        //     'count'   => $getOrderToApproveCount[0],
        //     'status'  => 200
        // ]);
        $getOrderToApproveCount = Order::join('order_invoice',  ['orders.invoice_id' => 'order_invoice.id'])
            ->where('is_approved',0)
                    ->groupBy('orders.invoice_id')    
                        ->get()
                            ->count();

        return response()->json([
            'count'   => $getOrderToApproveCount,
            'status'  => 200
        ]);
    }

    /*
    * Create a function display the count of products out of stocks
    */
    public function display_out_of_stocks_product_count(){
        // if(env("DB_CONNECTION") == "pgsql"){
        //     $getOutOfStocksProduct = DB::select("SELECT COUNT(*) as data FROM stocks WHERE quantity < threshold");
        // }else{
        //     $getOutOfStocksProduct = DB::select('SELECT COUNT(*) as data FROM stocks WHERE quantity < threshold');
        // }
        
        // return response()->json([
        //     'count'   => $getOutOfStocksProduct[0],
        //     'status'  => 200
        // ]);

        $getOutOfStocksProduct = DB::table('product_stocks')->where('quantity', 0)->get()->count();

        
        return response()->json([
            'count'   => $getOutOfStocksProduct,
            'status'  => 200
        ]);
    }

    /*
    * Create a function display the product of the month
    */
    public function display_product_of_the_month(){
        if(env("DB_CONNECTION") == "pgsql"){
            $getProductOfTheMonth = DB::select("SELECT name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE EXTRACT(MONTH FROM delivery_date) = EXTRACT(MONTH FROM CURRENT_DATE) GROUP BY name ORDER BY COUNT(name) DESC LIMIT 1");
            $getProductOfTheMonthImage = DB::select("SELECT product_image FROM orders INNER JOIN products ON orders.product_id = products.id WHERE EXTRACT(MONTH FROM delivery_date) = EXTRACT(MONTH FROM CURRENT_DATE) GROUP BY product_image ORDER BY COUNT(product_image) DESC LIMIT 1");
        }else{
            $getProductOfTheMonth = DB::select('SELECT name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE month(delivery_date) = MONTH(CURDATE()) GROUP BY name ORDER BY COUNT(name) DESC LIMIT 1');
            $getProductOfTheMonthImage = DB::select('SELECT product_image FROM orders INNER JOIN products ON orders.product_id = products.id WHERE month(delivery_date) = MONTH(CURDATE()) GROUP BY product_image ORDER BY COUNT(product_image) DESC LIMIT 1');
        }
        
        return response()->json([
            'data'   => $getProductOfTheMonth[0],
            'img'   => $getProductOfTheMonthImage[0],
            'status'  => 200
        ]);
    }
    protected function weeklySales($date){
        return DB::table('orders')->selectRaw('SUM(orders.ordered_total_price) as total_price')->where('delivery_date', $date)->where('is_completed',  1)->where('is_replacement', 0)->groupBy('invoice_id')->first();    
    }
    /*
    * Create a function display the weekly sales data
    */
    public function display_weekly_sales_data(Request $request){

        return response()->json([
            "sun"   =>      ['counts' => $this->weeklySales($request->input("sunday")) ? $this->weeklySales($request->input("sunday"))->total_price : 0],
            "mon"   =>      ['counts' => $this->weeklySales($request->input("monday")) ? $this->weeklySales($request->input("monday"))->total_price : 0],
            "tue"   =>      ['counts' => $this->weeklySales($request->input("tuesday")) ? $this->weeklySales($request->input("tuesday"))->total_price : 0],
            "wed"   =>      ['counts' => $this->weeklySales($request->input("wednesday")) ? $this->weeklySales($request->input("wednesday"))->total_price : 0],
            "thu"   =>      ['counts' => $this->weeklySales($request->input("thursday")) ? $this->weeklySales($request->input("thursday"))->total_price : 0],
            "fri"   =>      ['counts' => $this->weeklySales($request->input("friday")) ? $this->weeklySales($request->input("friday"))->total_price : 0],
            "sat"   =>      ['counts' => $this->weeklySales($request->input("saturday")) ? $this->weeklySales($request->input("saturday"))->total_price : 0],
        ]);
    }

    protected function monthlySales($year, $month, $type){
        return DB::table('orders')
                    // ->selectRaw('SUM(orders.ordered_total_price) as total_price')
                                    ->when($type, function($sql) use($type){
                                        if($type == 'sales'){
                                            return $sql->where('is_completed',  1)
                                                    ->where('is_replacement', 0)
                                                    ->where('is_damages', 0);
                                        } else {
                                            return $sql->where('is_replacement', 1);
                                                // ->OrWhere('is_damages', 1);
                                        }
                                    })
                                    ->whereYear('delivery_date', '=', $year)
                                    ->whereMonth('delivery_date', '=', $month)
                                    ->sum('ordered_total_price');
    }

    public function getYearStatistics(Request $request){
        return [
            'sales' => [
                $this->monthlySales($request->year, '01', 'sales'), //01,
                $this->monthlySales($request->year, '02', 'sales'), //02,
                $this->monthlySales($request->year, '03', 'sales'), //03,
                $this->monthlySales($request->year, '04', 'sales'), //04,
                $this->monthlySales($request->year, '05', 'sales'), //05,
                $this->monthlySales($request->year, '06', 'sales'), //06,
                $this->monthlySales($request->year, '07', 'sales'), //07,
                $this->monthlySales($request->year, '08', 'sales'), //08,
                $this->monthlySales($request->year, '09', 'sales'), //09,
                $this->monthlySales($request->year, '10', 'sales'), //10,
                $this->monthlySales($request->year, '11', 'sales'), //11,
                $this->monthlySales($request->year, '12', 'sales'), //12,
            ],
            'loss' => [
                $this->monthlySales($request->year, '01', 'loss'), //01,
                $this->monthlySales($request->year, '02', 'loss'), //02,
                $this->monthlySales($request->year, '03', 'loss'), //03,
                $this->monthlySales($request->year, '04', 'loss'), //04,
                $this->monthlySales($request->year, '05', 'loss'), //05,
                $this->monthlySales($request->year, '06', 'loss'), //06,
                $this->monthlySales($request->year, '07', 'loss'), //07,
                $this->monthlySales($request->year, '08', 'loss'), //08,
                $this->monthlySales($request->year, '09', 'loss'), //09,
                $this->monthlySales($request->year, '10', 'loss'), //10,
                $this->monthlySales($request->year, '11', 'loss'), //11,
                $this->monthlySales($request->year, '12', 'loss'), //12,
            ],
            'list' => [
                'January'   => $this->topStatistics($request->year, '01'),
                'February'  => $this->topStatistics($request->year, '02'),
                'March'     => $this->topStatistics($request->year, '03'),
                'April'     => $this->topStatistics($request->year, '04'),
                'May'       => $this->topStatistics($request->year, '05'),
                'June'      => $this->topStatistics($request->year, '06'),
                'July'      => $this->topStatistics($request->year, '07'),
                'August'    => $this->topStatistics($request->year, '08'),
                'September' => $this->topStatistics($request->year, '09'),
                'October'   => $this->topStatistics($request->year, '10'),
                'November'  => $this->topStatistics($request->year, '11'),
                'December'  => $this->topStatistics($request->year, '12')
            ]
        ];
    }

    public function topStatistics($year, $month){
        $list = array();
        $top_products =  DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->selectRaw('SUM(orders.ordered_total_price) as total_price, products.name as product_name')
            ->whereYear('orders.delivery_date', '=', $year)
            ->whereMonth('orders.delivery_date', '=', $month)
            ->where('is_completed',  1)
            ->groupBy('orders.product_id')
            ->limit(3)
            ->orderBy('total_price', 'desc')
            ->get();
        $products = '';    
        $total = 0;
        foreach ($top_products as $key => $value) {
           $total    .= '<br/>'.number_format($value->total_price,2);  
           $products .= '<br/>'.$value->product_name; 
        }
        return [
            'products' => substr($products, 5),
            'total'    =>  substr($total, 6)
        ];
    }

    /*
    * Create a function display the sales data
    */
    public function display_sales_data(Request $request){

        $data = DB::select("SELECT COUNT(*) as counts FROM orders WHERE is_completed = '1' AND is_replacement = '0' ");
        
        return response()->json([
            "data"   =>      $data[0]
        ]);
    }

    /*
    * Create a function display the loss data
    */
    public function display_loss_data(Request $request){

        $data = DB::select("SELECT COUNT(*) as counts FROM orders WHERE is_completed = '1' AND is_replacement = '1' ");
        
        return response()->json([
            "data"   =>      $data[0]
        ]);
    }




    /*
    * Create a function display the count of Orders to receive for client
    */
    public function display_order_to_receive_count_for_client(){
        // if(env("DB_CONNECTION") == "pgsql"){
        //     $getOrderToDeliverCount = DB::select('SELECT COUNT(*) as data FROM orders WHERE is_approved = "1" AND client_id = "'.Auth::user()->id.'" AND delivery_date = CURRENT_DATE');
        // }else{
        //     $getOrderToDeliverCount = DB::select('SELECT COUNT(*) as data FROM orders WHERE is_approved = 1 AND client_id = "'.Auth::user()->id.'" AND delivery_date = CURDATE()');
        // }

        $getOrderToDeliveerCount = Order::join('order_invoice',  ['orders.invoice_id' => 'order_invoice.id'])
            ->where('is_approved',1)
                ->where('client_id', Auth::user()->id)
                    ->groupBy('orders.invoice_id')    
                        ->get()
                            ->count();

        return response()->json([
            'count'   => $getOrderToDeliveerCount,
            'status'  => 200
        ]);
    }

    public function lowStocks()
    {
        // $products =  Product::with('stock')->get();

        // $lowStocks = $products->filter(function ($product) {
        //     return $product->stock->quantity < $product->stock->threshold;
        // });

        $lowStocks = DB::table('product_stocks')->whereRaw('quantity <= threshold && quantity > 0')->get()->count();

        return response()->json([
            'count'   => $lowStocks,
            'status'  => 200
        ]);
    }

    /*
    * Create a function display the count of Orders to approve for the specific client
    */
    public function display_order_to_approve_count_for_client(){
        // if(env("DB_CONNECTION") == "pgsql"){
        //     $getOrderToApproveCount = DB::select('SELECT COUNT(*) as data FROM orders WHERE is_approved = "0" AND client_id = "'.Auth::user()->id.'" ');
        // }else{
        //     $getOrderToApproveCount = DB::select('SELECT COUNT(*) as data FROM orders WHERE is_approved = 0 AND client_id = "'.Auth::user()->id.'" ');
        // }

        $getOrderToApproveCount = Order::join('order_invoice',  ['orders.invoice_id' => 'order_invoice.id'])
            ->where('is_approved',0)
                ->where('client_id', Auth::user()->id)
                    ->groupBy('orders.invoice_id')    
                        ->get()
                            ->count();
        
        return response()->json([
            'count'   => $getOrderToApproveCount,
            'status'  => 200
        ]);
    }

    /*
    * Create a function display the product of the month
    */
    public function display_3_best_product_of_the_month(){
        // if(env("DB_CONNECTION") == "pgsql"){
        //     $getProductOfTheMonth = DB::select("SELECT name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE EXTRACT(MONTH FROM delivery_date) = EXTRACT(MONTH FROM CURRENT_DATE) GROUP BY name ORDER BY COUNT(name) DESC LIMIT 3");
        //     $getProductOfTheMonthImage = DB::select("SELECT product_image FROM orders INNER JOIN products ON orders.product_id = products.id WHERE EXTRACT(MONTH FROM delivery_date) = EXTRACT(MONTH FROM CURRENT_DATE) GROUP BY product_image ORDER BY COUNT(product_image) DESC LIMIT 3");
        // }else{
        //     $getProductOfTheMonth = DB::select('SELECT name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE month(delivery_date) = MONTH(CURDATE()) GROUP BY name ORDER BY COUNT(name) DESC LIMIT 3');
        //     $getProductOfTheMonthImage = DB::select('SELECT product_image FROM orders INNER JOIN products ON orders.product_id = products.id WHERE month(delivery_date) = MONTH(CURDATE()) GROUP BY product_image ORDER BY COUNT(product_image) DESC LIMIT 3');
        // }
        
        // return response()->json([
        //     'data1'   => array_key_exists(0, $getProductOfTheMonth) ? $getProductOfTheMonth[0] : "....",
        //     'img1'   => array_key_exists(0, $getProductOfTheMonthImage) ? $getProductOfTheMonthImage[0] : "default.jpg",
        //     'data2'   => array_key_exists(1, $getProductOfTheMonth) ? $getProductOfTheMonth[1] : "....",
        //     'img2'   => array_key_exists(1, $getProductOfTheMonthImage) ? $getProductOfTheMonthImage[1] : "default.jpg",
        //     'data3'   => array_key_exists(2, $getProductOfTheMonth) ? $getProductOfTheMonth[2] : "....",
        //     'img3'   => array_key_exists(2, $getProductOfTheMonthImage) ? $getProductOfTheMonthImage[2] : "default.jpg",
        //     'status'  => 200
        // ]);

        // $top_products = DB::table('orders')
        //             ->select('SUM(orders.ordered_total_price) as total_price, products.name as product_name, products.product_image')
        //                 ->join('products', ['products.id' => 'orders.product_id'])
        //                     ->get();
        $top_products = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->selectRaw('SUM(orders.ordered_total_price) as total_price, products.name as product_name, products.product_image')
            ->groupBy('orders.product_id')
            ->limit(3)
            ->orderBy('total_price', 'desc')
            ->get();

            return $top_products;
            
        return response()->json($top_products);
    }
}
