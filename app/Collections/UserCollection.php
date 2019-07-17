<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class UserCollection extends Collection
{
    public function getEmails()
    {
        return $this->pluck('email');
    }
}
