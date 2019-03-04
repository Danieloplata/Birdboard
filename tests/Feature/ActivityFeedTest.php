<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_project_generate_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
    }
}
