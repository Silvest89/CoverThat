<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 19/02/2017
 * Time: 17:02
 */

namespace App\Repositories\Contracts;


interface UserInterface
{

    public function all($columns = array('*'));

    public function getUserById($id);

    public function getUserByEmail($email);

    public function createUserWithInformation($email, $firstName, $lastName);

}