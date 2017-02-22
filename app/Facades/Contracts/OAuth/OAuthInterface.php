<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 19/02/2017
 * Time: 08:27
 */

namespace App\Facades\Contracts\OAuth;


interface OAuthInterface
{

    function setSingleSignOnScopes();
    function createAuthUrl($scope = null) : ?string;
    function getAccessToken($authCode = null);
    function setAccessToken(string $token);
    function getRefreshToken() : ?string;
    function getProfileInfo();
}