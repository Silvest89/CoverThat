<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{

    public function getAccount() {

        return $this->belongsTo('App\Models\Account\User');
    }
}
