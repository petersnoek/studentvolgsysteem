<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardComposer
{
    protected $ownedGroups;

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->ownedGroups = Auth::user()->groups;
    }

    public function compose(View $view)
    {
        $view->with('ownedGroups', $this->ownedGroups);
    }
}
