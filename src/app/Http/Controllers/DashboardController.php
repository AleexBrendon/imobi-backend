<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Contract;
use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        return [
            'kanban' => [
                'prospect' => Client::where('company_id', $companyId)->where('status', 'prospect')->count(),
                'visit' => Client::where('company_id', $companyId)->where('status', 'visit')->count(),
                'proposal' => Client::where('company_id', $companyId)->where('status', 'proposal')->count(),
                'closed' => Client::where('company_id', $companyId)->where('status', 'closed')->count(),
            ],
            'activities' => Activity::where('company_id', $companyId)->latest()->take(5)->get(),
            'documents' => Document::where('company_id', $companyId)->latest()->take(6)->get(),
            'contracts' => Contract::where('company_id', $companyId)
                ->where('expires_at', '<=', now()->addDays(10))
                ->get()
        ];
    }
}
