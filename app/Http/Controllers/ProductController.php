<?php

namespace App\Http\Controllers;

use App\Product;
use App\{Stock,ProductStock};
use App\Variation;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Validator;
use Google\Cloud\Storage\StorageClient;

class ProductController extends Controller
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

    public function getLowStocks($product_id, $type = 'all'){
        if($type == 'all'){
            return ProductStock::where('product_id', $product_id)
                    ->whereRaw('quantity <= threshold')
                    ->orderBy('id', 'desc')
                    ->get();
        } else {
            return ProductStock::where('product_id', $product_id)
                        ->whereRaw('quantity <= threshold')
                                ->get()
                                    ->count();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::when($request->filter_status != 'all', function($sql) use($request){
                        return $sql->where('is_deleted', $request->filter_status);
                    })
                    ->latest()
                        ->get();
        if ($request->ajax()) {
            return Datatables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $status = '';
                    $delete_status = '';
                    $delete_btn = '';

                    if($row->is_deleted == 0){
                        $status = 0;
                        $delete_status = 'Phased out';
                        $delete_btn = 'btn-danger';
                    }else{
                        $status = 1;
                        $delete_status = 'Available';
                        $delete_btn = 'btn-success';
                    }
                    $stock = $this->getLowStocks($row->id, 'single');
                    $btn = '<a href="javascript://;" data-toggle="tooltip" data-placement="top" title="Update Product" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn .=' <a href="product/'.$row->id.'/edit" data-toggle="tooltip" data-placement="top" title="Stock" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->name.'" data-original-title="Stock" class="btn btn-warning btn-sm"> Manage Stock</a>';
                    $btn .=' <button type="button" '.($stock == 0 ? 'disabled' : '').' data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-id="'.$row->id.'"  class="btn btn-info btn-sm viewLowStocks">Low / Out of stocks                    ('.$stock.')</button>';

                    return $btn;
                })
                ->editColumn('is_deleted', function ($row) {
                    $status = '';
                    if($row->is_deleted == 0){
                        $status = '<span class="text-success font-weight-bold">Available</span>';
                    } 
                    else if($row->is_deleted == 1){
                        $status = '<span class="text-danger font-weight-bold">Phased out</span>';
                    } 
                     
                    // if($row->quantity == 0){
                    //     $status = '<span class="text-danger font-weight-bold"">Out of Stock</span>';
                    // } 
                    // else if($row->quantity <= $row->threshold){
                    //     $status = '<span class="text-warning font-weight-bold">Running Low</span>';
                    // }

                    return $status;
                })
                // ->editColumn('product_image', function ($row) {
                //     return 'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/product/' . $row->product_image;
                // })
                ->rawColumns(['action', 'is_deleted'])
                ->make(true);
        }

        return view('product/product', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        if ($request->ajax()) {
            $concat = "";
            if(!$request->product_id){
                $concat = "sss";
            }

            if(empty($request->product_id)){
                $image = $request->file('product_image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/product'), $new_name);
            } else {
                if($request->hasFile("product_image")){
                    $image = $request->file('product_image');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('img/product'), $new_name);
                } else {
                    $pdct = Product::find($request->product_id);
                    $new_name = $pdct->product_image;
                }
            }

            if($request->product_id){
                if($request->name != $request->name1){
                    if(Product::where('name', $request->name)->first()){
                        return response()->json([
                            'status'    => 'exist',
                            'message'   => 'Product Already Exist.'
                        ]);
                    } else {
                        // if(empty($request->product_id)){
                        //     $image = $request->file('product_image');
                        // } else {
                        //     if($request->hasFile("product_image")){
                        //         $image = $request->file('product_image');
                        //     } else {
                        //         $pdct = Product::find($request->product_id);
                        //         $new_name = $pdct->product_image;
                        //     }
                        // }
    
                        // if($request->hasFile("product_image")){
                        //     $path = \Storage::disk('public')->put('img/product', $image);
                        
                        //     #start here ============================================================
                        //     $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
                            
                        //     $storage = new StorageClient([
                        //         'keyFile' => json_decode($googleConfigFile, true)
                        //     ]);
    
                        //     $storageBucketName  = config('googlecloud.storage_bucket');
                        //     $bucket             = $storage->bucket($storageBucketName);
                        //     $fileSource         = fopen(storage_path('app/public/'.$path), 'r');
                            
                        //     $googleCloudStoragePath = $path;
    
                        //     $bucket->upload($fileSource, [
                        //         'predefinedAcl'  => 'publicRead',
                        //         'name'           => $googleCloudStoragePath
                        //     ]);
                        //     #end here ===============================================================
                        //     $new_name = str_replace("img/product/", "", $path);
                        // }
    
                        Product::updateOrCreate([
                            'id' => $request->product_id
                        ],[
                            'name'          => $request->name . $concat,
                            'description'   => $request->description . $concat,
                            'product_image' => $new_name,
                            'is_deleted'    => $request->is_deleted
                        ]);
                    }
                } else {
                    // if(empty($request->product_id)){
                    //     $image = $request->file('product_image');
                    // } else {
                    //     if($request->hasFile("product_image")){
                    //         $image = $request->file('product_image');
                    //     } else {
                    //         $pdct = Product::find($request->product_id);
                    //         $new_name = $pdct->product_image;
                    //     }
                    // }

                    // if($request->hasFile("product_image")){
                    //     $path = \Storage::disk('public')->put('img/product', $image);
                    
                    //     #start here ============================================================
                    //     $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
                        
                    //     $storage = new StorageClient([
                    //         'keyFile' => json_decode($googleConfigFile, true)
                    //     ]);

                    //     $storageBucketName  = config('googlecloud.storage_bucket');
                    //     $bucket             = $storage->bucket($storageBucketName);
                    //     $fileSource         = fopen(storage_path('app/public/'.$path), 'r');
                        
                    //     $googleCloudStoragePath = $path;

                    //     $bucket->upload($fileSource, [
                    //         'predefinedAcl'  => 'publicRead',
                    //         'name'           => $googleCloudStoragePath
                    //     ]);
                    //     #end here ===============================================================
                    //     $new_name = str_replace("img/product/", "", $path);
                    // }

                    Product::updateOrCreate([
                        'id' => $request->product_id
                    ],[
                        'name'          => $request->name . $concat,
                        'description'   => $request->description . $concat,
                        'product_image' => $new_name,
                        'is_deleted'    => $request->is_deleted
                    ]);
                }
            } else {
                if(Product::where('name', $request->name)->first()){
                    return response()->json([
                        'status'    => 'exist',
                        'message'   => 'Product Already Exist.'
                    ]);
                } else {
                    // if(empty($request->product_id)){
                    //     $image = $request->file('product_image');
                    // } else {
                    //     if($request->hasFile("product_image")){
                    //         $image = $request->file('product_image');
                    //     } else {
                    //         $pdct = Product::find($request->product_id);
                    //         $new_name = $pdct->product_image;
                    //     }
                    // }

                    // if($request->hasFile("product_image")){
                    //     $path = \Storage::disk('public')->put('img/product', $image);
                    
                    //     #start here ============================================================
                    //     $googleConfigFile = file_get_contents(config_path('googlecloud.json'));
                        
                    //     $storage = new StorageClient([
                    //         'keyFile' => json_decode($googleConfigFile, true)
                    //     ]);

                    //     $storageBucketName  = config('googlecloud.storage_bucket');
                    //     $bucket             = $storage->bucket($storageBucketName);
                    //     $fileSource         = fopen(storage_path('app/public/'.$path), 'r');
                        
                    //     $googleCloudStoragePath = $path;

                    //     $bucket->upload($fileSource, [
                    //         'predefinedAcl'  => 'publicRead',
                    //         'name'           => $googleCloudStoragePath
                    //     ]);
                    //     #end here ===============================================================
                    //     $new_name = str_replace("img/product/", "", $path);
                    // }

                    Product::updateOrCreate([
                        'id' => $request->product_id
                    ],[
                        'name'          => $request->name .$concat,
                        'description'   => $request->description .$concat,
                        'product_image' => $new_name,
                        'is_deleted'    => $request->is_deleted
                    ]);
                }
            }

            return response()->json([
                'status'    => 'success',
                'message'   => 'Product Successfully submitted.',
                200
            ]);
        }
    }

    //create a function that will return the data for 
    public function return_price_value($size_value){
        
        if(count($size_value) == 1) $price_value = '0,';
        if(count($size_value) == 2) $price_value = '0,0,';
        if(count($size_value) == 3) $price_value = '0,0,0,';
        if(count($size_value) == 4) $price_value = '0,0,0,0,';
        if(count($size_value) == 5) $price_value = '0,0,0,0,0,';
        if(count($size_value) == 6) $price_value = '0,0,0,0,0,0,';
        if(count($size_value) == 7) $price_value = '0,0,0,0,0,0,0,';
        if(count($size_value) == 8) $price_value = '0,0,0,0,0,0,0,0,';
        if(count($size_value) == 9) $price_value = '0,0,0,0,0,0,0,0,0,';
        if(count($size_value) == 10) $price_value = '0,0,0,0,0,0,0,0,0,0,';

        //return the data
        return $price_value;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit_product($id)
    {
        // $product = Product::with('images')->find($id);
        // $variation = Variation::where('product_id', $id)->first();
        // $stock = Stock::where('product_id', $id)->first();

        // $data = [
        //   'product' => $product,
        //   'variation' => $variation,
        //   'stock' => $stock,
        // ];

        $product = Product::find($id);
        $stocks  = ProductStock::where('product_id', $id)->where('quantity','!=', 0)->where('status',  0)->get();

        $data = [
          'product' => $product,
        //   'variation' => $variation,
          'stocks' => $stocks,
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $variation = Variation::where('product_id', $id)->first();
        $stock = Stock::where('product_id', $id)->first();

        $data = [
          'product' => $product,
          'variation' => $variation,
          'stock' => $stock,
        ];

        return view('product.edit')->with($data);



        // // return response
        // $response = [
        //     'success' => true,
        //     'product_id' => $product->id,
        //     'product_name' => $product->name,
        //     'product_description' => $product->description,
        //     'variation_data' => $variation,
        //     // 'message' => 'Product saved successfully.',
        // ];

        // return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $output = '';

        // $product->delete();
        if($product->is_deleted == 0){
            Product::where('id', $product->id)->update(["is_deleted" => 1]);
            $output = 'Successfully Deactivated!';
        }else{
            Product::where('id', $product->id)->update(["is_deleted" => 0]);
            $output = 'Successfully Activated!';
        }

        // return response
        $response = [
            'success', true,
            'message' => $output,
        ];
        return response()->json($response, 200);
    }

    public function getSizes($id)
    {
        // $variation =  Variation::where('product_id', $id)->first();

        // $sizes = explode(',', $variation->size);

        // $formatted = array_map(function($size) {
        //     $size = $size;
        //     if ($size) {
        //         return (int) $size;
        //     }
        // }, $sizes);

        // return response()->json($formatted);

        // $variation =  Variation::where('product_id', $id)->first();

        // $sizes = explode(',', $variation->size);
        // $prices = explode(',', $variation->price);
        // $data = array();
        // foreach ($sizes as $key => $value) {
        //     if($value)
        //         $data[$prices[$key]] = $value;
        // }
        $data  = ProductStock::where('product_id', $id)->where('quantity','!=', 0)->where('status',  0)->get();
        return response()->json($data);
    }

    public function getProductRow(Request $request){
        if ($request->ajax()) {
            $stock = Product::find($request->id);
            return response()->json($stock);
        }
    }
}
