<?php

namespace App\Http\Controllers;

use Validator;
use App\Status;
use App\Contact;
use App\GroupContact;
use App\GroupContactMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        //hold variables
        $totalClients = 0;
        $totalProspects = 0;
        $totalLukewarm = 0;

        //Check contacts
        if (!empty($company->contacts)){
            //Loop through each contacts
            foreach($company->contacts as $contact){
                //add total
                $totalClients = $totalClients + 1;
                //check status
                if ($contact->status->name == 'prospect'){
                    //add total
                    $totalProspects = $totalProspects + 1;
                }elseif($contact->status->name == 'lukewarm'){
                    //add total
                    $totalLukewarm = $totalLukewarm + 1;
                }
            }
        }

        return view(
            'dashboard.contact.index', 
            ['company' => $company, 
            'statuses' => $statuses, 
            'totalContact' => $totalClients,
            'totalProspect' => $totalProspects,
            'totalLukewarm' => $totalLukewarm ]);
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

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listGroupContact()
    {
        //Get Company
        $company = Auth::user()->company;
        //Get Statuses
        $statuses = Status::all();
        //hold variables
        $totalClients = 0;
        $totalProspects = 0;
        $totalLukewarm = 0;

        //Check contacts
        if (!empty($company->contacts)){
            //Loop through each contacts
            foreach($company->contacts as $contact){
                //add total
                $totalClients = $totalClients + 1;
                //check status
                if ($contact->status->name == 'prospect'){
                    //add total
                    $totalProspects = $totalProspects + 1;
                }elseif($contact->status->name == 'lukewarm'){
                    //add total
                    $totalLukewarm = $totalLukewarm + 1;
                }
            }
        }

        return view(
            'dashboard.contact.group', 
            ['company' => $company, 
            'statuses' => $statuses, 
            'totalContact' => $totalClients,
            'totalProspect' => $totalProspects,
            'totalLukewarm' => $totalLukewarm ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGroupContact(Request $request)
    {
        //Get Company
        $company = Auth::user()->company;
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'contacts' => 'required'
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        //Create group contact
        $groupContact = new GroupContact();
        $groupContact->company_id = $company->id;
        $groupContact->name = $request->name;
        //save group template
        if ($groupContact->save()){
            //create group contact member
            //Loop through each contact
            foreach($request->contacts as $contact){
                //Create new member
                $groupContactMember = new GroupContactMember();
                $groupContactMember->company_id = $company->id;
                $groupContactMember->group_contacts_id = $groupContact->id;
                $groupContactMember->contacts_id = $contact;
                if (!$groupContactMember->save()){
                    //add flash message on error
                    $request->session()->flash('message', 'An error occured while creating the group contact. please try again');
                    //Return redirect
                    return redirect()->back();
                }
            }
        }

        //add flash message on success
        $request->session()->flash('message', 'Group Contact created successfully');
        //Return redirect
        return redirect()->back();
    }

    public function editGroupContact(GroupContact $groupContact){
        //Get Company
        $company = Auth::user()->company;
        //Get Statuses
        $statuses = Status::all();
        //hold variables
        $totalClients = 0;
        $totalProspects = 0;
        $totalLukewarm = 0;
        //Hold Members
        $members = [];

        //Check contacts
        if (!empty($company->contacts)){
            //Loop through each contacts
            foreach($company->contacts as $contact){
                //add total
                $totalClients = $totalClients + 1;
                //check status
                if ($contact->status->name == 'prospect'){
                    //add total
                    $totalProspects = $totalProspects + 1;
                }elseif($contact->status->name == 'lukewarm'){
                    //add total
                    $totalLukewarm = $totalLukewarm + 1;
                }
            }
        }

        foreach($groupContact->contacts as $member){
            array_push($members, $member->firstname);
        }

        return view(
            'dashboard.contact.edit-group', 
            ['company' => $company, 
            'statuses' => $statuses, 
            'totalContact' => $totalClients,
            'totalProspect' => $totalProspects,
            'totalLukewarm' => $totalLukewarm,
            'groupContact' => $groupContact,
            'members' => $members ]);
    }

    public function updateGroupContact(Request $request, GroupContact $groupContact){
        //Get Company
        $company = Auth::user()->company;
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'contacts' => 'required'
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $groupContact->name = $request->name;
        //save group contact
        if ($groupContact->save()){
            //Get Group Contact Members
            $groupContactMembers = GroupContactMember::where('company_id', $company->id)
                                        ->where('group_contacts_id', $groupContact->id)
                                        ->get();
            //Check groupContactMembers
            if (!empty($groupContactMembers)){
                //Loop through each group contact members
                foreach($groupContactMembers as $member){
                //Delete members
                $member->delete();
                }
            }
            //create group member
            //Loop through each contacts
            foreach($request->contacts as $contact){
                //Create new members
                $groupContactMember = new GroupContactMember();
                $groupContactMember->company_id = $company->id;
                $groupContactMember->group_contacts_id = $groupContact->id;
                $groupContactMember->contacts_id = $contact;
                if (!$groupContactMember->save()){
                    //add flash message on error
                    $request->session()->flash('message', 'An error occured while updating the group contact. please try again');
                    //Return redirect
                    return redirect()->back();
                }
            }
        }

        //add flash message on success
        $request->session()->flash('message', 'Group Contact updated successfully');
        //Return redirect
        return redirect()->route('group-contacts');
    }

    public function deleteGroupContact(GroupContact $groupContact, Request $request){
        //Delete Grou[p Template
        $groupContact->delete();
         //add flash message on error
         $request->session()->flash('message', 'Group Contact deleted');
         //Return redirect
         return redirect()->route('group-contacts');
    }

    public function confirmDeleteGroupContact(GroupContact $groupContact, Request $request){
        //Construct message
        $message = "Are you sure you want to delete? ";
        //Add To Message
        $message .= "<a href='".route('delete-group-contact', ['groupContact' => $groupContact])."'>Yes</a> ";
        //Add To Message
        $message .= "<a href='".route('group-contacts')."'>No</a>";
        //add flash message on error
        $request->session()->flash('message', $message);
        //Return redirect
        return redirect()->back();
    }
}
