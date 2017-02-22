<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 19/02/2017
 * Time: 17:02
 */

namespace App\Repositories\Eloquents;

use App\Models\Account\UserInformation;
use App\Repositories\Contracts\UserInterface;
use App\Models\Account\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;

class UserRepository implements UserInterface
{

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {

        return $this->model->get($columns);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {

        return $this->model->find($id);
    }


    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {

        return $this->model->where('email', $email)->first();
    }


    public function createUserWithInformation($email, $firstName, $lastName)
    {

        $user = $this->getUserByEmail($email);

        if($user) {

            return $user;
        }
        else {
            try {

                $user = new User;
                $user->email = $email;
                $user->password = Hash::make(str_random(12));
                $user->save();

                $userInformation = new UserInformation;
                $userInformation->first_name = $firstName;
                $userInformation->last_name = $lastName;

                $user->getInformation()->save($userInformation);

                return $user;

            } catch (Exception $e) {

                Log::info($e->getMessage());
            }
        }

        return false;
    }
}