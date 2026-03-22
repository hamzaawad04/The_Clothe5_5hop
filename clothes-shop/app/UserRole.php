<?php

namespace App;

enum UserRole: string
{
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
}
