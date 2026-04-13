<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Document;
use App\Models\Contract;
use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return [
            'kanban' => [
                'prospect' => Client::where('status','prospect')->count(),
                'visit' => Client::where('status','visit')->count(),
                'proposal' => Client::where('status','proposal')->count(),
                'closed' => Client::where('status','closed')->count(),
            ],
            'activities' => Activity::latest()->take(5)->get(),
            'documents' => Document::latest()->take(6)->get(),
            'contracts' => Contract::where('expires_at','<=',now()->addDays(10))->get()
        ];
    }
}