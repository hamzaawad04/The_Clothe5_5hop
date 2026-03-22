<?php

namespace App;

enum OrderStatus: string
{
    case PENDING = 'Pending';
    case PAID = 'Paid';
    case SHIPPED = 'Shipped';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';
    case RETURNREQUESTED = 'Return Requested';
    case RETURNACCEPTED = 'Return Accepted';
    case REFUNDED = 'Refunded';
}
