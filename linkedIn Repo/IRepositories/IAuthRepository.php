<?php

require_once '../../Models/User.php';

interface IAuthRepository
{
    public function loginQuery(User $user);

    public function checkRegisterQuery(User $user);

    public function registerQuery(User $user);
}