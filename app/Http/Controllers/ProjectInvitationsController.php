<?php

namespace App\Http\Controllers;


use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project)
    {
        request()->validate([
            'email' => 'exists:users,email'
        ], [
            'email.exists' => 'The user you are inviting must have an account'
        ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);
    }
}
