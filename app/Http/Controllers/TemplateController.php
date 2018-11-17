<?php

namespace App\Http\Controllers;

use Validator;
use App\Template;
use App\SmsTemplate;
use Illuminate\Http\Request;
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
        //Render View
        return view('dashboard.template.index', ['smsTemplates' => $smsTemplates, 'emailTemplates' => $emailTemplates]);
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
        //Validate Submission
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'body' => 'required',
        ]);
        //Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        //Create new sms template
        $sms = new SmsTemplate($request->all());
        //Add company to sms
        $sms->company_id = $company->id;
        //Check if sms was saved
        if ($sms->save()) {
            //add flash message on success
            $request->session()->flash('message', 'Template saved successfully');
            //Return redirect
            return redirect()->route('tempates');
        }
        //add flash message on error
        $request->session()->flash('message', 'An error occured while creating the template. please try again');
        //Return redirect
        return redirect()->route('tempates');
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
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
