<?php

namespace UniqueLoneDog\Authentification;

use Phalcon\Mvc\User\Component;
use UniqueLoneDog\Models\User;

/**
 * Validation methods for authentification
 *
 * @author Patrick
 */
class Authentification extends Component
{

    public function isValidLogin($email, $password)
    {
        // Check if the user exist
        $user = User::findFirstByEmail($email);
        if (!$user) {
            return false;
        }

        // Check the password
        $passString = $user->salt + $password;
        if (!$this->security->checkHash($passString, $user->passhash)) {

            return false;
        }

        return true;
    }

    public function isValidToken($userId, $userToken, $cookieToken)
    {
        if ($userToken !== $cookieToken) {
            return false;
        }

        $conditions = array(
            "uid" => $userId,
            "token" => $userToken,
            "expire" => time() - (86400 * 7) // A week
        );

        $rows = $this->modelsManager->createBuilder()
                        ->from("RememberToken")
                        ->where("userId = :uid:")
                        ->andWhere("token = :token:")
                        ->andWhere("createdAt < :expire:")
                        ->getQuery()->execute($conditions);

        return count($rows) > 0;
    }

}
