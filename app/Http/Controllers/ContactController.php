<?php

namespace App\Http\Controllers;

use App\Status;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get user
        $user = Auth::user();
        //Get Company
        $company = $user->company;
        //Get Statuses
        $statuses = Status::all();

        return view('dashboard.contact.index', ['company' => $company, 'statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Handle Form Submission
        if ($request->filled('firstName') || $request->filled('lastName')){
            //Check if either phone or email was filed
            if($request->filled('phone') || $request->filled('email')){
                //Get Status
                $status = Status::where(array('name' => $request->status))->first();
                //Create New Contact
                $contact = new Contact();
                //Set Contact Details
                $contact->firstname = $request->firstName;
                $contact->lastname = $request->lastName;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->status_id = $status->id;
                $contact->address = $request->address;
                //Save Contact to Company
                Auth::user()->company->contacts()->save($contact);
                //add flash message on succesful conatct saved
                $request->session()->flash('message', 'Contact saved successfully');
                //return to contacts
                return redirect()->route('contacts');
            }else{
                $request->session()->flash('message', 'You need to add at least one contact information');
                //return to contacts
                return redirect()->route('contacts');
            }
            
        }
        //return to contacts
        return redirect()->route('contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }

     /**
     * Change Contact Status.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Contact $contact, Request $request)
    {
        //Get all Status
        $statuses = Status::all();
        //Loop through each status
        foreach($statuses as $status){
            //Set status
            if ($status->name == 'prospect'){
                $prospect = $status;
            }elseif($status->name == 'lead'){
                $lead = $status;
            }elseif($status->name == 'client'){
                $client = $status;
            }else{
                $lukewarm = $status;
            }
        }
        //Check status
        if ($contact->status == $prospect){
            //set new status
            $contact->status_id = $lead->id;
        }elseif($contact->status == $lead){
            //set new status
            $contact->status_id = $client->id;
        }elseif($contact->status == $client){
            //set new status
            $contact->status_id = $lukewarm->id;
        }else{
            //set new status
            $contact->status_id = $prospect->id;
        }

        //Save Contact
        $contact->save();
        //add flash message on succesful conatct saved
        $request->session()->flash('message', 'Status updated');
        //return to contacts
        return redirect()->route('contacts');
    }
}
