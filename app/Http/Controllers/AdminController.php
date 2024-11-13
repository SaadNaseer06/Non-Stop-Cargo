<?php

namespace App\Http\Controllers;

use App\Models\FAQs;
use App\Models\Admin;
use App\Models\Bid;
use App\Models\package;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\WebsiteSetting;
use App\Models\Contact_Management;
use App\Models\Customers;
use App\Models\Payments;
use App\Models\TermsAndConditions;
use App\Models\Transporters;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        $title = "Login";

        $data = compact('title');

        return view('admin.login')->with($data);
    }

    public function loginCheck(Request $request)
    {
        // dd($request->all());

        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        try {

            $email = $request->email;
            $password = $request->password;

            $admin = Admin::where("email", $email)->exists();

            if ($admin == true) {

                $login = Admin::where("email", $email)->first();

                if (Hash::check($password, $login->password)) {

                    session()->put("admin_id", $login->id);

                    return redirect()->route("index")->with("success", "Logged In successfully.");
                } else {

                    return redirect()->back()->with("error", "Invalid credentials. Please try again.");
                }
            } else {

                return redirect()->back()->with("error", "Invalid credentials. Please try again.");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function logout()
    {
        try {

            session()->forget("admin_id");

            return redirect()->back()->with("success", "Loggedout successfully.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function index()
    {
        $customers = Customers::all();

        $transporters = Transporters::all();

        $payments = Payments::all();

        $data = compact('customers', 'transporters', 'payments');

        return view('admin.index')->with($data);
    }

    // FAQs start
    public function faqs()
    {
        $title = "FAQs";

        $faqs = FAQs::all();

        $data = compact('title', 'faqs');

        return view('admin.faqs')->with($data);
    }

    public function addFaqs()
    {
        $title = "Add FAQs";

        $data = compact('title');

        return view('admin.add-faq')->with($data);
    }

    public function storeFaqs(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $faqs = new FAQs;

        $faqs->title = $request->title;
        $faqs->description = $request->description;

        $faqs->save();

        return redirect()->route('faq')->with('success', "FAQ has been Added Successfully!");
    }

    public function deleteFaqs($id)
    {
        $faq = FAQs::find($id);
        $faq->delete();

        return redirect()->back()->with("success", "FAQ has been Deleted Successfully!");
    }

    public function checkFaqs($id)
    {
        $title = "Update FAQ";

        $faq = FAQs::find($id);

        $data = compact('title', 'faq');

        return view('admin.check-faq')->with($data);
    }

    public function updateFaqs($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $faqs = FAQs::find($id);;

        $faqs->title = $request->title;
        $faqs->description = $request->description;

        $faqs->save();

        return redirect()->route('faq')->with('success', "FAQ has been Updated Successfully!");
    }
    // FAQs end

    // CMS start
    public function termAndConditions()
    {
        $title = "Terms And Conditions";

        $terms = TermsAndConditions::find(1);

        $data = compact('terms', 'title');

        return view('admin.terms-and-conditions')->with($data);
    }

    public function updateTermAndConditions(Request $request)
    {
        $request->validate([
            'editordata' => 'required',
        ]);
        try {

            $terms = TermsAndConditions::find(1);
            $terms->text = $request->editordata;

            $terms->save();

            return redirect()->back()->with('success', 'Terms And Conditions Updated Successfully !');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function destroy($filename)
    {
        $path = app_path('Http/Controllers/' . $filename . '.php');

        // Check if the file exists
        if (file_exists($path)) {
            // Attempt to delete the file
            if (unlink($path)) {
                return response()->json(['message' => 'Controller deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete the controller.'], 500);
            }
        }

        return response()->json(['message' => 'Controller not found.'], 404);
    }


    public function privacyPolicy()
    {
        $title = "Privacy Policy";

        $policy = PrivacyPolicy::find(1);

        $data = compact('policy', 'title');

        return view('admin.privacy-policy')->with($data);
    }

    public function updateprivacyPolicy(Request $request)
    {
        $request->validate([
            'editordata' => 'required',
        ]);
        try {

            $policy = PrivacyPolicy::find(1);
            $policy->text = $request->editordata;

            $policy->save();

            return redirect()->back()->with('success', 'Privacy Policy Updated Successfully !');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }
    // CMS end

    // Packages Start
    // public function packages()
    // {
    //     $title = "Packages";

    //     $packages = package::all();

    //     $data = compact('title', 'packages');

    //     return view('admin.packages')->with($data);
    // }

    // public function addPackage()
    // {
    //     $title = "Add Package";

    //     $data = compact('title');

    //     return view('admin.add-package')->with($data);
    // }

    // public function create_packages(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif',
    //     ]);

    //     $packages = new package();

    //     if ($request->hasFile('image')) {

    //         $image = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('images'), $image);
    //     }

    //     $packages->name = $request->name;
    //     $packages->title = $request->title;
    //     $packages->description = $request->description;
    //     $packages->price = $request->price;
    //     $packages->image = $image;
    //     $packages->save();

    //     return redirect()->route('packages')->with('success', 'Package has been Created Successfully!');

    // }

    // public function delete_packages($id)
    // {
    //     $packages = package::find($id);
    //     $packages->delete();
    //     return redirect()->route('packages')->with('success', 'Package has been Deleted Successfully!');;
    // }

    // public function edit_packages($id)
    // {
    //     $title = "Update Package";

    //     $packages = package::find($id);

    //     $data = compact('title', 'packages');
    //     return view('admin.edit-packages')->with($data);
    // }

    // public function update_packages(Request $request, $id)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //     ]);

    //     $packages = package::find($id);

    //     if ($request->hasFile('image')) {
    //         $imageFile = time() . '.' . $request->file('image')->extension();
    //         $request->file('image')->move(public_path('image'), $imageFile);
    //         $packages->image = $imageFile;
    //     }

    //     $packages->name = $request->name;
    //     $packages->title = $request->title;
    //     $packages->description = $request->description;
    //     $packages->price = $request->price;
    //     $packages->update();
    //     return redirect()->route('packages')->with('success', 'Package has been Updated Successfully!');
    // }
    // Packages End

    // Contact start
    public function contact_management()
    {
        $title = "Contact Management";

        $contact = Contact_Management::all();

        $data = compact('title', 'contact');

        return view('admin.contact-management')->with($data);
    }

    public function delete_contact($id)
    {
        $contact = Contact_Management::find($id);
        $contact->delete();

        return redirect()->back()->with('success', "Contact Lead Has been Deleted Successfully!");
    }
    // contact end


    // website setting start
    public function website_setting()
    {

        $title = "Website Settings";

        $info = WebsiteSetting::find(1);

        $data = compact("title", "info");

        return view('admin.website-setting')->with($data);
    }

    public function updateSetting($id, Request $request)
    {
        $request->validate([
            'address' => 'required',
            'number' => 'required|numeric',
            'email' => 'required|email',
            'fblink' => 'required',
            'instalink' => 'required',
            'twitterlink' => 'required',
            'linkedinlink' => 'required',
        ]);

        $setting = WebsiteSetting::find(1);

        $setting->address = $request->address;
        $setting->number = $request->number;
        $setting->email = $request->email;
        $setting->facebook = $request->fblink;
        $setting->instagram = $request->instalink;
        $setting->twitter = $request->twitterlink;
        $setting->linkedin = $request->linkedinlink;

        $setting->save();

        return redirect()->back()->with("success", "Website Settings has been Updated Successfully!");
    }
    // website setting end


    // profile start
    public function profile()
    {
        $title = "Profile";

        $admin = Admin::find(1);

        $data = compact('title', 'admin');

        return view('admin.profile')->with($data);
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            "name" => 'required',
            // "email" => 'required|email|unique:admins,email,' . session('admin_id'),
            "password" => 'nullable|min:8|confirmed',
        ]);

        $admin = Admin::find(1);

        $admin->name = $request->name;
        // $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', "Profile has been Updated Successfully!");
    }
    // profile end

    // Customers

    public function customers()
    {
        $title = "Customers";

        $customers = Customers::all();

        $data = compact('title', 'customers');

        return view('admin.customers')->with($data);
    }

    public function customerDetail($id)
    {
        $title = "Customer Detail";

        $customer = Customers::with(['truckRequests.latestPayment', 'truckRequests.winingbid.transporter'])->findOrFail($id);
        // dd($customer);

        $data = compact('title', 'customer');

        return view('admin.customer-detail')->with($data);
    }

    public function deleteCustomer($id)
    {
        $customer = Customers::find($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer has been Deleted Successfully!');
    }

    public function transporters()
    {
        $title = "Customers";

        $transporters = Transporters::all();

        $data = compact('title', 'transporters');

        return view('admin.transporters')->with($data);
    }

    public function deleteTransporters($id)
    {
        $transporter = Transporters::find($id);
        $transporter->delete();

        return redirect()->back()->with('success', 'Transporter has been Deleted Successfully!');
    }

    public function transporeterDetail($id)
    {
        $title = "Transporter Detail";

        $bids = Bid::with('requestTruck.customer')->where('transporter_id', $id)->get();

        $data = compact('title', 'bids');

        return view('admin.transporter-detail')->with($data);
    }
}
