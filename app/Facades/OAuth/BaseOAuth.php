<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 18/02/2017
 * Time: 13:19
 */

namespace App\Facades\OAuth;

use App\Facades\Contracts\OAuth\OAuthInterface;
use Illuminate\Support\Facades\Facade;
use Facebook\Facebook;

/**
 * This is the Main OAuth base class.
 *
 */
class BaseOAuth extends Facade
{

    protected $client;
    protected $loginUrl;


}