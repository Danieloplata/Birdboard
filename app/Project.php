<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    use RecordsActivity;

	protected $guarded = [];

	public function path()
	{
		return '/projects/' . $this->id;
	}

	public function owner()
	{
		return $this->belongsTo(User::class);
	}

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}

	public function addTask($body)
	{
		return $this->tasks()->create(compact('body'));
	}

    /**
     * Invite a user to the project.
     *
     * @param \App\User $user
     */
    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    /**
     * The activity feed for the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
