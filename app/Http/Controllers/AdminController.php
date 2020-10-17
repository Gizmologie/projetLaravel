<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Product;
use App\Services\MailerService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * @var MailerService
     */
    private $mailerService;

    /**
     * ProductController constructor.
     * @param MailerService $mailerService
     */
    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUser()
    {
        $users = User::all();
        return view('admin.adminUser')->with('users', $users);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexProduct()
    {
        $products = Product::all();
        return view('admin.adminProduct')->with('products', $products);
    }

    /**
     * route possiblement obsolete
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetailsUser($id)
    {
        $users = User::where('id', $id)->firstOrFail();
        return view('detailsUser')->with('users', $users);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.updateUser')->with('user', $user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(UpdateUserRequest $request, $id)
    {
        $params = $request->validated();
        $post = User::findOrFail($id);
        $post->update($params);
        return redirect()->route('adminUser');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsProduct ($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.updateProduct')->with('product', $product);
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct (UpdateProductRequest $request, $id)
    {
        $params = $request->validated();
        $post = Product::findOrFail($id);
        $post->update($params);
        return redirect()->route('adminProduct');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct ($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/'.$product->image);
        $product->delete();
        return back();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createUser ()
    {
        return view('admin.createUser');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser (StoreUserRequest $request)
    {
        $params = $request->validated();
        $params['password'] = Hash::make($params['password']);
        User::create($params);
        return redirect()->route('adminUser');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createProduct ()
    {
        $categories = Category::all();
        return view('admin.createProduct')->with('categories', $categories);
    }

    /**
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProduct (StoreProductRequest $request)
    {
        $params = $request->validated();
        $params['slug'] = Str::slug($params['name'], '-');
        Storage::put('public/products', $params['image']);
        $params['image'] = 'products/'. $params['image']->hashName();
        if(isset($params['promotion'])) {
            $params['price'] = $params['base_price'] - ($params['base_price'] * ($params['promotion']/100));
        } else {
            $params['price'] = $params['base_price'];
        }
        Product::create($params);
        return redirect()->route('adminProduct');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPassword()
    {
        return view('auth.password.reset');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailResetPassword(Request $request)
    {
        $email = $request->all()['email'];
        $users = User::all();
        $code = random_int(100000, 999999);
        foreach ($users as $user)
        {
            if ($user['email'] === $email)
            {
                $response = $this->mailerService->sendMail(
                    [
                        'Email' => $email,
                        'Name' => 'e_commerce'
                    ], 'Reset Password', 'mails.resetPassword', ['user' => $user, 'code' =>$code]);
            }
        }

        return view('pages.mail.codeVerification')
            ->with('email', $email)
            ->with('code', $code);
        die;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword(Request $request)
    {
        $params = $request->all();
        $params['password'] = Hash::make($params['password']);
        $user = User::findOrFail(Auth::id());
        $user->update($params);
        return redirect()->route('home');
    }
}
