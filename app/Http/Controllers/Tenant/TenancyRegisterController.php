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
        dd($request->all());

        $tenant = Tenant::create($request->validated());

        $tenant->createDomain(['domain' => $request->domain]);

        return redirect()->back()->with("success", "Successfully Created Tenant With  Domain");
    }





    // For Each tenants addBlog postBlog editBlog deleteBlog
    public function addBlog(Request $request)
    {
        // Retrieve the tenant's database name
        $tenantId = tenant('id');
        $db_user = 'tenant' . $tenantId;

        config(['database.connections.tenant.database' => $db_user]);

        // Reconnect to the tenant's database
        DB::connection('tenant')->reconnect();

        if (DB::connection('tenant')->getPdo()) {

            $basic = DB::connection('tenant')
                ->table('users')
                ->where('status', 'basic')
                ->exists();

            $standard = DB::connection('tenant')
                ->table('users')
                ->where('status', 'standard')
                ->exists();


            $premium = DB::connection('tenant')
                ->table('users')
                ->where('status', 'premium')
                ->exists();

            if ($basic) {
                // return view('blog.add_blog');
                // return "Basic Status contains db tennat! " . tenant('id');
                return view('blog.basic_add_blog');
            } elseif ($standard) {
                // return "Sandard Status contains db tennat! " . tenant('id');
                return view('blog.basic_add_blog');
            } elseif ($premium) {
                // return "Premium Status contains db tennat! " . tenant('id');
                return view('blog.basic_add_blog');
            } else {
                return "Other Unknown Tenants Uer Tables Status with Tenant Id: " . tenant('id');
            }
        } else {
            return "No connection is made";
        }
    }

    public function postBlog(Request $request)
    {
        $tenantId = tenant('id');
        $db_user = 'tenant' . $tenantId;

        config(['database.connections.tenant.database' => $db_user]);
        DB::connection('tenant')->reconnect();

        if (DB::connection('tenant')->getPdo()) {

            $basic = DB::connection('tenant')->table('users')->first();
        }
        // dd($basic );

        $request->validate([
            'blog' => 'required|string|max:255',
            'des' => 'required|string',
        ]);

        $currentDate = Carbon::now()->toDateString();

        $todayRecordCount = Blog::whereDate('created_at', $currentDate)->count();

        // dd( $todayRecordCount);
        // $basic->status;
        // dd( $todayRecordCount );
        if ($basic->status === 'basic') {
            if ($todayRecordCount < 5) {

                $blog = new Blog();
                $blog->name = $request->blog;
                $blog->description = $request->des;
                $blog->tenant_status = 'basic';
                $blog->save();

                $blogs = Blog::all();

                // return view('blog.show_basic_blogs', compact('blogs'));

                // dd($blogs);
                return redirect()->back()->with('blogs', $blogs)->with('msg', "Blogs successfully Created");
            }
            else {

                return redirect()->back()->with('msg', "Limits are extended! You can post minimum 5 blogs per day.");
            }
        } 



        if ($basic->status === 'standard') {
            if ($todayRecordCount < 7) {

                $blog = new Blog();
                $blog->name = $request->blog;
                $blog->description = $request->des;
                $blog->tenant_status = 'standard';
                $blog->save();
    
                $blogs = Blog::all();
    
                // return view('blog.show_basic_blogs', compact('blogs'));
    
                // dd($blogs);
                return redirect()->back()->with('blogs', $blogs)->with('msg', "Blogs successfully Created");
            }
            else {

                return redirect()->back()->with('msg', "Limits are extended! You can post  minimum of 7 blogs per day.");
            }
        }
         

        if ($basic->status == 'premium') {

            $blog = new Blog();
            $blog->name = $request->blog;
            $blog->description = $request->des;
            $blog->tenant_status = 'standard';
            $blog->save();

            $blogs = Blog::all();

            // return view('blog.show_basic_blogs', compact('blogs'));

            return redirect()->back()->with('blogs', $blogs)->with('msg', "Blogs successfully Created");
        } 
        
       
    }


    public function showBlog(Request $request)
    {
        $blogs = Blog::all();

        return view('blog.show_basic_blogs', compact('blogs'));
    }

    public function editBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        //  dd($blog);
        return view('blog.update_blog', compact('blog'));
    }

    public function postEditBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        // dd($blog);

        if ($blog) {
            $blog->name = $request->blog ?? $blog->blog;
            $blog->description = $request->des ?? $blog->description;
            $blog->tenant_status = $request->block_status ?? $blog->tenant_status;

            $blog->save();

            return redirect()->back();
        }
        return view('blog.update_blog', compact('blog'));
    }

    public function deleteBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect()->back();
    }

    // Others code
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
