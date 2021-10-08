<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AuthenticatedComposer
{
    /**
     *
     * @var object $authenticated
     */
    protected $authenticated;

    public function __construct()
    {
        $this->authenticated = auth()->user();
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('authenticated', $this->authenticated);
    }
}
