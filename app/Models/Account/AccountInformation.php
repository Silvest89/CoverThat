<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class AccountInformation extends Model
{

    public function getAccount() {

        return $this->belongsTo('App\Account');
    }
}
