<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ContactEnquiryMail as ContactEnquiry;


class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable|string|max:15',
            'message' => 'nullable|string|max:1000',
        ]);

        Contact::create([
            'property_id' => $request->property_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => '0',
        ]);

        $notification = [
            'message' => 'Enquiry Sent successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function EnquiryRequest()
    {
        $enquiryRequests = Contact::with('property')->get();
        return view('backend.property.enquiry_request', compact('enquiryRequests'));
    }

    public function EnquiryView($id)
    {
        $enquiry = Contact::with('property')->findOrFail($id);
        return view('backend.property.enquiry_view', compact('enquiry'));
    }

    public function UpdateEnquiry(Request $request)
    {
        $enquiryId = $request->id;
        Contact::findOrFail($enquiryId)->update([
            'status' => '1',
            'updated_at' => Carbon::now(),
        ]);

        // Send Email
        $sendMail = Contact::findOrFail($enquiryId);
        $data = [
            'name' => $sendMail->name,
            'email' => $sendMail->email,
            'phone' => $sendMail->phone,
            'property_address' => $sendMail->property->address,
        ];
        // dd($data);
        Mail::to($sendMail->email)->send(new ContactEnquiry($data));

        $notification = [
            'message' => 'Enquiry Request Confirmed Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('property.enquiry.request')->with($notification);
    }

    public function DeleteEnquiry($id)
    {
        Contact::findOrFail($id)->delete();
        $notification = [
            'message' => 'Enquiry Request Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
