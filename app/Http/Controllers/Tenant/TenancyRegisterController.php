<?php

namespace App\Http\Controllers\Tenant;

use Carbon\Carbon;
use App\Models\Blog;

use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenancyRegisterRequest;

class TenancyRegisterController extends Controller
{


    // From super admin manage
    public function tenancyRegister(Request $request)
    {
        // dd("Tenancy Register");
        return view('tenant.tenancy-register');
    }
    public function postRegister(StoreTenancyRegisterRequest $request)
    {
        // dd($request->all());

        $tenant = Tenant::create($request->validated());

        $tenant->createDomain(['domain' => $request->domain]);

        return redirect()->back()->with("success", "Successfully Created Tenant With  Domain");
    }

    public function subscription(Request $request)
    {
        return view('subscription');
    }

    public function PermissionSubscription(Request $request)
    {
        return view('tenant.create');
    }

    //SQLSTATE[HY000] [1049] Unknown database 'tenant_f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'
    public function FirstTenantBlogs(Request $request)
    {
        // $all = $request->all();
        // dd($all);
        $tenantId = 'f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);
        DB::connection('tenant')->reconnect();

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        // DD($currentDate);
        // Count the records created today
        $todayRecordCount = Blog::whereDate('created_at', $currentDate)->count();
        // DD($todayRecordCount); 
        // Check if the count is less than 5
        if ($todayRecordCount < 5) {
            // Create a new blog record
            $blog = new Blog();
            $blog->name = $request->blog;
            $blog->post = $request->post;
            $blog->description = $request->des;
            $blog->save();
            return "Data successfully stored";
        } else {
            // If the limit is reached
            return "You can only store 5 records per day";
        }

        // return redirect()->back();
        // $blogs = Blog::all();
        // return "Data Stored Successfully";
        // return view('tenant.show1', compact('blogs'));
    }


    public function  show1(Request $request)
    {
        $tenantId = 'f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);
        DB::connection('tenant')->reconnect();


        // return redirect()->back();
        $blogs = Blog::all();
        // return "Data Stored Successfully";
        return view('tenant.show1', compact('blogs'));
    }

    public function  abcBlogEdit(Request $request, $id)
    {

        $tenantId = 'f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::find($id);
        return view('tenant.abc_blog_edit', compact('blog'));
    }

    public function  postAbcBlog(Request $request, $id)
    {

        $tenantId = 'f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::on('tenant')->find($id);
        // dd($blog );

        if ($blog) {
            $blog->name = $request->blog ?? $blog->blog;
            $blog->post = $request->post ?? $blog->post;
            $blog->description = $request->des ?? $blog->description;
            $blog->save();

            return redirect()->back();
        }
        // return redirect()->back()->with('error', 'Blog not found.');
    }

    public function  abcBlogDelete(Request $request, $id)
    {

        $tenantId = 'f44fb7e1-91cf-40cc-9755-ca5f7aa25c7f'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name
        // dd($tenantDatabase);
        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::on('tenant')->find($id);
        // dd($blog); //record is present

        $blog->delete();
        return redirect()->back();
    }

    public function SecondTenantPost(Request $request)
    {
        $all = $request->all();
        // dd($all);
        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);
        DB::connection('tenant')->reconnect();

        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Count the records created today
        $todayRecordCount = Blog::whereDate('created_at', $currentDate)->count();

        // Check if the count is less than 5
        if ($todayRecordCount < 7) {
            // Create a new blog record


            $blog = new Blog();
            $blog->name = $request->blog;
            $blog->post = $request->post;
            $blog->description = $request->des;
            $blog->save();


            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->des;
            $product->save();

            return "Data successfully stored";
        } else {
            // If the limit is reached
            return "You can only store 7 records per day";
        }
    }

    public function  show2(Request $request)
    {
        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);
        DB::connection('tenant')->reconnect();

        $blogs = Blog::all();
        $products = Product::all();

        return view('tenant.show2', compact('blogs', 'products'));
    }


    public function  mimiBlogEdit(Request $request, $id)
    {

        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::find($id);

        return view('tenant.mimi_blog_edit', compact('blog'));
    }


    public function  postMimiBlog(Request $request, $id)
    {

        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::on('tenant')->find($id);

        // dd($blog );

        if ($blog) {
            $blog->name = $request->blog ?? $blog->blog;
            $blog->post = $request->post ?? $blog->post;
            $blog->description = $request->des ?? $blog->description;
            $blog->save();
            return redirect()->back();
        }
        // return redirect()->back()->with('error', 'Blog not found.');
    }



    public function  mimiProductEdit(Request $request, $id)
    {

        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $product = Blog::find($id);

        return view('tenant.mimi_blog_edit', compact('product'));
    }

    public function  postMimiproduct(Request $request, $id)
    {
        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name

        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $product = Product::on('tenant')->find($id);

        // dd($blog );

        if ($product) {
            $product->name = $request->name ?? $product->name;
            $product->description = $request->des ?? $product->description;
            $product->save();

            return redirect()->back();
        }
        // return redirect()->back()->with('error', 'Blog not found.');
    }

    public function  mimiBlogDelete(Request $request, $id)
    {

        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name
        // dd($tenantDatabase);
        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $blog = Blog::on('tenant')->find($id);
        // dd($blog); //record is present

        $blog->delete();
        return redirect()->back();
    }

    public function  mimiProductDelete(Request $request, $id)
    {

        $tenantId = '8179e33b-f288-4706-9b7e-06cd28e9a3df'; // Example tenant ID
        $tenantDatabase = 'tenant' . $tenantId; // Example dynamic database name
        // dd($tenantDatabase);
        // Set the database connection dynamically
        config(['database.connections.tenant.database' => $tenantDatabase]);

        $product = Product::on('tenant')->find($id);
        // dd($blog); //record is present

        $product->delete();
        return redirect()->back();
    }
}
