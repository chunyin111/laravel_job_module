<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use \App\Mail\JobPosted;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::with('employer')->orderBy('created_at', 'desc')->Paginate(4); 

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create(){
        return view('jobs.create');
    }

    public function show(Job $job){
        return view('jobs.show', ['job' => $job]);
    }

    public function store(){
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        // send() immediete send email 
        Mail::to($job->employer->user)->queue( // can don write ->email because, laravel was smart will grab email
            new JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job){
        //1st option
        // Gate::authorize('edit-job', $job); // go Providers/AppServiceProvider check function

        //2nd option
        // if(Auth::user()->cannot('edit-job', $job)){
        //     dd('cscs');
        // }

        //3rd Option
        // if($job->employer->user->isNot(Auth::user())){
        //     abort(403);
        // }
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job){
        Gate::authorize('edit-job', $job); 

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        //authorize
        //update the job
        // $job = Job::findOrFail($id);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);
        //redirect to job page
        return redirect('/jobs/'.$job->id);
    }

    public function destroy(Job $job){
        Gate::authorize('edit-job', $job); 

        $job->delete();

        return redirect('/jobs');
    }
}
