<?php

namespace App\Livewire\Staff;

use App\Enum\ActivityType;
use App\Models\Activity;
use Livewire\Component;

class RecentActivityCard extends Component
{

    public function render()
    {
        $activities = Activity::latest()->take(3)->get()->map(function($activity) {
            return (object)[
                'type' => $activity->type,
                'description' => $activity->description,
                'created_at' => $activity->created_at->diffForHumans(),
                'color' => ActivityType::tryFrom($activity->type)->color(),
            ];
        });;
        return view('livewire.staff.recent-activity-card', [
            'activities' => $activities,
        ]);
    }
}
