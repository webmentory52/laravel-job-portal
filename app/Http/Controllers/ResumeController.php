<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function show(JobApplication $application)
    {
        if(!$application->resume) return;

        // Restrict showing resume to applicant or owning company or superadmin
        abort_unless(
            auth()->user()->id === $application->user_id ||
            auth()->user()?->getCompany()?->id === $application->candidateJob->company->id ||
            auth()->user()->isAdmin(),
            403
        );

        return Storage::download($application->resume);
    }
}
