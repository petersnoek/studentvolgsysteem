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
        // TODO: Auth::user (laravel) is not the same as a backpack authenticated user. Once we login to the admin dashboard,
        // we are logged in as a backpack user. Auth::user() is then null.
        $this->ownedGroups = backpack_auth()->user()->groups;
    }

    public function compose(View $view)
    {
        $view->with('ownedGroups', $this->ownedGroups);
    }
}
