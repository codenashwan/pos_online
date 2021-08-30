<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sidebar;
use App\User;
use App\supplier;
use App\stocks;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\sold;
use Auth;
class HomeController extends Controller
{
 
    public function __construct(){
        $this->middleware('auth');
    }


    public function sidebar(){
        return sidebar::all();
    }

   
    public function index(){
        $sidebar = $this->sidebar();
        return view('sale' ,compact('sidebar'));
    }


    // Cashier Page
    public function Cashier(){
        $sidebar = $this->sidebar();
        $cashiers = User::all();
        return view('cashier' , compact('sidebar' , 'cashiers'));
    }

    public function AddCashier(Request $request){
        $validator = \Validator::make($request->all() , [
            'name' => 'required',
            'email'  => 'required',
            'password'  => 'required',
            'rule' => 'required'
            ]);
        if($validator->fails()){
        return redirect('cashier')->withErrors($validator);
        }else{
           $create_user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rule' => $request->rule
            ]);
            return $create_user ? redirect('cashier')->with('result' , 'The Cashier Was Successfuly !') : redirect('cashier')->with('result' , 'Some Thing Went Wrong !');       
        }
    }


    // Supplier Page
    public function supplier(){
        $sidebar = $this->sidebar();
        $supplier = supplier::paginate(30);
        return view('supplier' , compact('sidebar' , 'supplier'));
    }

    public function AddSupplier($status , $id , Request $request){
        if($status == 0){
            $validator = \Validator::make($request->all() , [
                'name' => 'required',
                'email'  => 'required',
                'address'  => 'required',
                'phonenumber' => 'required'
            ]);

            if($validator->fails()){
               return redirect('supplier')->withErrors($validator);
            }else{
                // Create
            $supplier = supplier::create([
                'company_name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phonenumber' => $request->phonenumber
            ]);
            }
            }elseif($status == 1 && !empty($status) && !empty($id)){
                // Delete
            $supplier = supplier::findOrfail($id);
            $supplier->delete();
            }else{
            $validator = \Validator::make($request->all() , [
                'name' => 'required',
                'email'  => 'required',
                'address'  => 'required',
                'phonenumber' => 'required'
                ]);
            if($validator->fails()){
               return redirect('supplier')->withErrors($validator);
            }else{
                // Update
            $supplier = supplier::where('id' , $id )->update([
                    'company_name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phonenumber' => $request->phonenumber
            ]);
            }
        }
        return $supplier ? redirect('supplier')->with('result' , 'The Supplier Was Successfuly !') : redirect('supplier')->with('result' , 'Some Thing Went Wrong !');   

    } 



    // Buy Page
    public function buy(){
        $sidebar = $this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::with('one_supplier')->orderBy('id','DESC')->paginate(30);
        return view('stocks' , compact('sidebar' , 'stocks' , 'suppliers'));
    }
    public function add_stock($status , $id , Request $request){
        $requires = [
        'id' => 'required',
        'name' => 'required',
        'supplier_id'  => 'required',
        'count'  => 'required',
        'price' => 'required',
        'expire_date' => 'required',
        'is_debt' => 'required',
        'type' => 'required',
        ];
        $fill = [
        'id' => $request->id,
        'name' => $request->name,
        'supplier_id' => $request->supplier_id,
        'count' => $request->count,
        'price' => $request->price,
        'expire_date'=> $request->expire_date,
        'is_debt' => $request->is_debt,
        'type' => $request->type
        ];
        if($status == 0){
            $validator = \Validator::make($request->all() , $requires);
            if($validator->fails()){
               return redirect('buy')->withErrors($validator);
            }else{
            $stocks = stocks::create($fill);
            }
            }elseif($status == 1 && !empty($status) && !empty($id)){
            $stocks = stocks::findOrfail($id)->delete();
            }else{
            $validator = \Validator::make($request->all() ,$requires);
            if($validator->fails()){
               return redirect('buy')->withErrors($validator);
            }else{
            $stocks = stocks::where('id' , $id )->update($fill);
            }
        }
        return $stocks ? redirect('buy')->with('result' , 'The Stocks Was Successfuly !') : redirect('buy')->with('result' , 'Some Thing Went Wrong !');   
    } 


    public function notleft(){
        $sidebar = $this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('count' , '<' , 2)->with('one_supplier')->orderBy('id','DESC')->paginate(30);
        return view('notleft' , compact('sidebar' , 'stocks','suppliers'));
    }

    public function debtlist(){
        $sidebar = $this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('is_debt' , 1)->with('one_supplier')->orderBy('id','DESC')->paginate(30);
        return view('debtlist' , compact('sidebar' , 'stocks','suppliers'));
    }

    public function expire(){
        $sidebar = $this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('expire_date' , '<=' , Carbon::today() )->with('one_supplier')->orderBy('id','DESC')->paginate(30);
        return view('expire' , compact('sidebar' , 'stocks','suppliers'));
    }


    public function sellers(){
        $lists = [
            'All Pieces' => sold::where('clean' , 1)->sum('piece'),
            'All Price' => sold::where('clean' , 1)->sum('price_at'),
            'All Pieces Today' => sold::where(['clean' => 1 , 'created_at' => Carbon::today()])->sum('piece'),
            'All Price Today' => sold::where(['clean' => 1 , 'created_at' => Carbon::today()])->sum('price_at'),
        ];
        $sidebar = $this->sidebar();
        $solds = sold::where('clean' , 1)->orderBy('id','DESC')->paginate(60);
        return view('sellers' , compact('sidebar', 'solds' , 'lists'));
    }


    public function sale(){
        $sidebar = $this->sidebar();
        return view('sale' , compact('sidebar'));
    }
    public function get_sale(Request $request){
       if(empty($request->id)){
           exit("Your Code is Empty");
       }
       $stock = stocks::find($request->id);
       if($stock){
        if($stock->count != 0){
           if($stock->expire_date > Carbon::today()){
            $stock->count = $stock->count - 1;
            $stock->save();

            $find_sold = sold::where(['user_id' => Auth::id() , 'stock_id' => $stock->id , 'clean' => 0])->first();
            if($find_sold == null){
            $sold = sold::create([
                'user_id' => Auth::id(),
                'stock_id' => $stock->id,
                'clean' => 0,
                'price_at' => $stock->price,
                'piece' => 1
            ]);
            return $sold ? "success" : "Something Went Wrong !";
            }else{
                $find_sold->piece = $find_sold->piece + 1;
                $find_sold->save();
                return "success";
            }
           }else{
             exit("The Product is Expired !");
           }
        }else{
            exit("The Product is no longer available !");
        }
       }else{
           exit("The Product Not Found !");
       }
    }

    public function viewtb(){
        $solds = sold::where(['user_id' => Auth::id() , 'clean' => 0])->orderBy('updated_at', 'DESC')->get();
        return view('layout.table' , compact('solds')); 
    }

    public function undo(Request $request){
        $find_sold = sold::where(['clean' => 0 , 'user_id' => Auth::id()])->find($request->sold_id);
        if($find_sold){
        $find_stock = stocks::find($find_sold->stock_id);
        if($find_stock){
        // Count + 1
        $find_stock->count = $find_stock->count + 1;
        $find_stock->save();
        // Piece - 1
        if($find_sold->piece == 1){
            $find_sold->delete();
        }else{
        $find_sold->piece = $find_sold->piece - 1;
        $find_sold->save();
        }
        return "success";
        }else{
            exit("fail");
        }
        }else{
            exit("fail");
        }
    }

    public function invoice(){
        $solds = sold::where(['user_id' => Auth::id() , 'clean' => 0])->get();
        return view('layout.invoice' , compact('solds'));
    }

    public function clean(){
        $solds = sold::where('user_id'  , Auth::id())->update(['clean' => 1]);
        return redirect("sale");
    }
}
