<?php

namespace App;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case RETURNREQUEST = 'returnRequested';
    case RETURNACCEPTED = 'returnAccepted';
    case REFUNDED = 'refunded';
}
