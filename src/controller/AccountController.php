<?php
require_once __DIR__ . '/Controller.php';

class AccountController extends Controller
{
    public function index(): void
    {
        $this->view('account', [
            'pageTitle' => 'Личный кабинет',
            'user' => Auth::user(),
        ]);
    }
}
