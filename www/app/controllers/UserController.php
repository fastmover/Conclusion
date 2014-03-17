<?php

    class UserController extends BaseController {

    /**
    * The layout that should be used for responses.
    */
    protected $layout = 'layouts.master';

    /**
    * Show the user profile.
    */
    public function signUp()
    {
        $this->layout->content = View::make('user.signup');
    }

}