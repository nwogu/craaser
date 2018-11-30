<?php

namespace App\Http\Controllers;

use Validator;
use App\Template;
use App\SmsTemplate;
use App\EmailTemplate;
use App\GroupTemplate;
use App\GroupMessageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Company
        $company = Auth::user()->company;
        //Get Sms Templates
        $smsTemplates = $company->smsTemplates;
        //Get Email Templates
        $emailTemplates = $company->emailTemplates;
        //hold variables
        $totalTemplates = 0;
        $totalSmsTemplates = 0;
        $totalEmailTemplates = 0;
        //Hold Template pack
        $templates = [];
        //Check sms templates
        if (!empty($company->smsTemplates)){
            //Loop through each sms template
            foreach($company->smsTemplates as $smsTemplate){
                //add total
                $totalSmsTemplates = $totalSmsTemplates + 1;
                //add to template pack
                array_push($templates, $smsTemplate);
            }
            //Loop through each email template
            foreach($company->emailTemplates as $emailTemplate){
                //add total
                $totalEmailTemplates = $totalEmailTemplates + 1;
                //add to templates pack
                array_push($templates, $emailTemplate);
            }
            //Calculate total templates
            $totalTemplates = $totalSmsTemplates + $totalEmailTemplates;
        }
        //Render View
        return view(
            'dashboard.template.index', 
            [
                'smsTemplates' => $smsTemplates, 
                'emailTemplates' => $emailTemplates,
                'totalTemplate' => $totalTemplates,
                'totalEmailTemplate' => $totalEmailTemplates,
                'totalSmsTemplate' => $totalSmsTemplates,
                'company' => $company,
                'templates' => $templates
            ]);
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
        //Get Company
        $company = Auth::user()->company;
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'body' => 'required',
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        //Create new template
        $template = new EmailTemplate($request->all());
        //Add company to template
        $template->company_id = $company->id;
        //Check if template was saved
        if ($template->save()) {
            //add flash message on success
            $request->session()->flash('message', 'Template saved successfully');
            //Return redirect
            return redirect()->back();
        }
        //add flash message on error
        $request->session()->flash('message', 'An error occured while creating the template. please try again');
        //Return redirect
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $template)
    {
        //Get Company
        $company = Auth::user()->company;
        //Get Sms Templates
        $smsTemplates = $company->smsTemplates;
        //Get Email Templates
        $emailTemplates = $company->emailTemplates;
        //hold variables
        $totalTemplates = 0;
        $totalSmsTemplates = 0;
        $totalEmailTemplates = 0;
        //Hold Template pack
        $templates = [];
        //Check sms templates
        if (!empty($company->smsTemplates)){
            //Loop through each sms template
            foreach($company->smsTemplates as $smsTemplate){
                //add total
                $totalSmsTemplates = $totalSmsTemplates + 1;
                //add to template pack
                array_push($templates, $smsTemplate);
            }
            //Loop through each email template
            foreach($company->emailTemplates as $emailTemplate){
                //add total
                $totalEmailTemplates = $totalEmailTemplates + 1;
                //add to templates pack
                array_push($templates, $emailTemplate);
            }
            //Calculate total templates
            $totalTemplates = $totalSmsTemplates + $totalEmailTemplates;
        }
        //Return Edit view
        return view('dashboard.template.edit', [
            'smsTemplates' => $smsTemplates, 
            'emailTemplates' => $emailTemplates,
            'totalTemplate' => $totalTemplates,
            'totalEmailTemplate' => $totalEmailTemplates,
            'totalSmsTemplate' => $totalSmsTemplates,
            'company' => $company,
            'templates' => $templates,
            'template' => $template
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $template)
    {
        //Get Company
        $company = Auth::user()->company;
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'body' => 'required',
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        //Check if template was saved
        if ($template->update($request->all())) {
            //add flash message on success
            $request->session()->flash('message', 'Template updated successfully');
            //Return redirect
            return redirect()->route('templates');
        }
        //add flash message on error
        $request->session()->flash('message', 'An error occured while updating the template. please try again');
        //Return redirect
        return redirect()->route('templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $template, Request $request)
    {
        $template->delete();
         //add flash message on error
         $request->session()->flash('message', 'This template, '.$template->name.' is deleted');
         //Return redirect
         return redirect()->route('templates');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listGroupTemplate()
    {
        //Get Company
        $company = Auth::user()->company;
        //Get Sms Templates
        $smsTemplates = $company->smsTemplates;
        //Get Email Templates
        $emailTemplates = $company->emailTemplates;
        //Get Group Templates
        $groupTemplates = $company->groupTemplates;
         
        //hold variables
        $totalTemplates = 0;
        $totalSmsTemplates = 0;
        $totalEmailTemplates = 0;

        $templates = [];

        foreach($company->emailTemplates as $emailTemplate){
            //add total
            $totalEmailTemplates = $totalEmailTemplates + 1;
            //add to templates pack
            array_push($templates, $emailTemplate);
        }

        //Render View
        return view(
            'dashboard.template.group', 
            [
                'smsTemplates' => $smsTemplates, 
                'emailTemplates' => $emailTemplates,
                'totalTemplate' => $totalEmailTemplates,
                'totalEmailTemplate' => $totalEmailTemplates,
                'totalSmsTemplate' => $totalSmsTemplates,
                'company' => $company,
                'templates' => $templates,
                'groupTemplates' => $groupTemplates
            ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGroupTemplate(Request $request)
    {
        //Get Company
        $company = Auth::user()->company;
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'templates' => 'required'
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        //Create group template
        $groupTemplate = new GroupTemplate();
        $groupTemplate->company_id = $company->id;
        $groupTemplate->name = $request->name;
        //save group template
        if ($groupTemplate->save()){
            //create group message templates
            //Loop through each templates
            foreach($request->templates as $template){
                //Create new template
                $groupMessageTemplate = new GroupMessageTemplate();
                $groupMessageTemplate->company_id = $company->id;
                $groupMessageTemplate->group_templates_id = $groupTemplate->id;
                $groupMessageTemplate->email_templates_id = $template;
                if (!$groupMessageTemplate->save()){
                    //add flash message on error
                    $request->session()->flash('message', 'An error occured while creating the group template. please try again');
                    //Return redirect
                    return redirect()->back();
                }
            }
        }

        //add flash message on success
        $request->session()->flash('message', 'Group Template created successfully');
        //Return redirect
        return redirect()->back();
    }

    public function editGroupTemplate(GroupTemplate $groupTemplate){
        //Get Company
        $company = Auth::user()->company;
        //Get Sms Templates
        $smsTemplates = $company->smsTemplates;
        //Get Email Templates
        $emailTemplates = $company->emailTemplates;
         
        //hold variables
        $totalTemplates = 0;
        $totalSmsTemplates = 0;
        $totalEmailTemplates = 0;

        $templates = [];

        $messages = [];

        foreach($company->emailTemplates as $emailTemplate){
            //add total
            $totalEmailTemplates = $totalEmailTemplates + 1;
            //add to templates pack
            array_push($templates, $emailTemplate);
        }

        foreach($groupTemplate->messages as $message){
            //add to messages pack
            array_push($messages, $message);
        }

        //Render View
        return view(
            'dashboard.template.edit-group', 
            [
                'smsTemplates' => $smsTemplates, 
                'emailTemplates' => $emailTemplates,
                'totalTemplate' => $totalEmailTemplates,
                'totalEmailTemplate' => $totalEmailTemplates,
                'totalSmsTemplate' => $totalSmsTemplates,
                'company' => $company,
                'templates' => $templates,
                'groupTemplate' => $groupTemplate,
                'messages' => $messages
            ]);
    }
}
