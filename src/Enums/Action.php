<?php

namespace Sxtnmedia\SaloonModelify\Enums;

enum Action: string
{
    case CREATE = 'create';

    case GET = 'get';

    case FIND = 'find';

    case UPDATE = 'update';

    case DELETE = 'delete';
}
