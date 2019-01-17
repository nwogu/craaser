<?php

namespace App\Http\Controllers;

use App\Campaign;
use Validator;
use App\Status;
use App\Contact;
use App\GroupContact;
use App\GroupContactMember;
use App\EmailTemplate;
use App\GroupTemplate;
use App\GroupMessageTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CampaignController extends Controller
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
        //Get all campaigns
        $campaigns = $company->campaigns;
        //hold total count
        $totalCampaign = 0;
        //Hold active count
        $activeCampaign = 0;
        //Hold paused count
        $pausedCampaign = 0;

        foreach($campaigns as $campaign){
            //count total
            $totalCampaign++;
            //Check campaign
            if ((!$campaign->is_active) && ($campaign->is_active !== null)){
                //count paused
                $pausedCampaign++;
            }else{
                //count active
                $activeCampaign++;
            }
        }

        return view('dashboard.campaign.index', array(
            'activeCampaign' => $activeCampaign,
            'totalCampaign' => $totalCampaign,
            'pausedCampaign' => $pausedCampaign,
            'company' => $company,
            'campaigns' => $campaigns
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get user
        $user = Auth::user();
        //Get Company
        $company = $user->company;
        //Get all campaigns
        $campaigns = $company->campaigns;
        //hold total count
        $totalCampaign = 0;
        //Hold active count
        $activeCampaign = 0;
        //Hold paused count
        $pausedCampaign = 0;

        foreach($campaigns as $campaign){
            //count total
            $totalCampaign++;
            //Check campaign
            if ((!$campaign->is_active) && ($campaign->is_active !== null)){
                //count paused
                $pausedCampaign++;
            }else{
                //count active
                $activeCampaign++;
            }
        }
        //return view
        return view('dashboard.campaign.create-step-one', array(
            'activeCampaign' => $activeCampaign,
            'totalCampaign' => $totalCampaign,
            'pausedCampaign' => $pausedCampaign,
            'company' => $company,
            'campaigns' => $campaigns
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
