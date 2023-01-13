<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;

class PageController extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
        // return view('page.trangchu');
        // return view('page.trangchu', compact('slide'));
        $new_product = Product::where('new', 1)->paginate(8);
        $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(4);
        return view('page.trangchu', compact('slide', 'new_product', 'sanpham_khuyenmai'));
    }

    public function getLoaiSp($type)
    {
        $type_product = ProductType::all();

        $sp_theoloai = Product::where('id_type', $type)->get();

        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);

        $loai_sp = ProductType::where('id', $type)->first();

        return view('page.loai_sanpham', compact('type_product', 'sp_theoloai', 'sp_khac', 'loai_sp'));
    }

    public function getModel()
    {
        return view('page.product_model');
    }

    public function getDetail(Request $request)
    {
        $sanpham =  Product::where('id', $request->id)->first();

        $splienquan = Product::where('id', '<>', $sanpham->id, 'and', 'id_type', '=', $sanpham->id_type,)->paginate(3);

        $comments = Comment::where('id_product', $request->id)->get();

        return view('page.chitiet_sanpham', compact('sanpham', 'splienquan', 'comments'));
    }

    public function getAddToCart(Request $req, $id)
    {
        // if (Session()->has('user')) {
        if (Product::find($id)) {
            $product = Product::find($id);
            $oldCart = Session('cart') ? Session()->get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $id);
            $req->session()->put('cart', $cart);
            return redirect()->back();
            //     } else {
            //         return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';
            //     }     
            // }  else {
            //     return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';
        }
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session('cart') ? Session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItems($id);
        if (count($cart->items) > 0) {
            Session()->put('cart', $cart);
        } else {
            Session()->forget('cart');
        }
        return redirect()->back();
    }

    // ------------------------ CHECKOUT -------------------															
    public function getCheckout()
    {
        if (Session()->has('cart')) {
            $oldCart = Session()->get('cart');
            $cart = new Cart($oldCart);
            return view('page.checkout')->with([
                'cart' => Session()->get('cart'),
                'product_cart' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty
            ]);;
        } else {
            return view('page.checkout');
        }
        return view('page.checkout');
    }
    public function postCheckout(Request $req)
    {
        $cart = Session()->get('cart');
        $customer = new Customer;
        $customer->name =  $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone_number;
        // $customer->note = $req->notes;
        if (isset($req->notes)) {
            $customer->note = $req->notes;
        } else {
            $customer->note = "Không có ghi chú gì";
        }

        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $req->totalPrice;
        $bill->payment = $req->payment_method;
        if (isset($req->notes)) {
            $bill->note = $req->notes;
        } else {
            $bill->note = "Không có ghi chú gì";
        }
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key; //$value['item']['id'];												
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            $bill_detail->save();
        }

        Session()->forget('cart');
        // $wishlists = Wishlist::where('id_user', Session()->get('user')->id)->get();
        // if (isset($wishlists)) {
        //     foreach ($wishlists as $element) {
        //         $element->delete();
        //     }
        // }
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
    }

    public function Register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        $input['password'] = bcrypt($input['password']);
        User::create($input);

        echo '
            <script>
                alert("Đăng ký thành công. Vui lòng đăng nhập.");
                window.location.assign("login")  
            </script>
        ';
    }

    public function Login(Request $request)
    {
        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('pw')
        ];
        if (Auth()->attempt($login)) {
            $user = Auth()->user();
            Session()->put('user', $user);
            echo '<script>alert("Đăng nhập thành công.");window.location.assign("trangchu");</script>';
        } else {
            echo '<script>alert("Đăng nhập thất bại.");window.location.assign("login");</script>';
        }
    }

    public function Logout()
    {
        Session()->forget('user');
        Session()->forget('cart');
        return redirect('/trangchu');
    }

    // ------------------------ ADMIN -------------------	
    public function getIndexAdmin()
    {
        $products = Product::all();
        return view('pageadmin.admin')->with(['products' => $products, 'sumSold' => count(BillDetail::all())]);
    }

    public function getAdminAdd()
    {
        return view('pageadmin.formAdd');
    }

    public function postAdminAdd(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product', $fileName);
        }
        $file_name = null;
        if ($request->file('inputImage') != null) {
            $file_name = $request->file('inputImage')->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function getAdminEdit($id)
    {
        $product = Product::find($id);
        return view('pageadmin.formEdit')->with('product', $product);
    }

    public function postAdminEdit(Request $request)
    {
        $id = $request->editId;

        $product = Product::find($id);
        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName('editImage');
            $file->move('source/image/product', $fileName);
        }

        if ($request->file('editImage') != null) {
            $product->image = $fileName;
        }

        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function postAdminDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->getIndexAdmin();
    }

    public function getContact()
    {
        return view('page.contact');
    }

    public function getAbout()
    {
        return view('page.about');
    }
}
