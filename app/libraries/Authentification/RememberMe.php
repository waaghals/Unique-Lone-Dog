<?php

namespace UniqueLoneDog\Authentification;

use UniqueLoneDog\Models\User;
use UniqueLoneDog\Models\RememberToken;
use Phalcon\Mvc\User\Component;

/**
 * Description of RememerMe
 *
 * @author Patrick
 */
class RememberMe extends Component
{

    const TOKEN = "RMT";
    const USER  = "RMU";

    /**
     * Set the rememberme token in the cookie
     *
     * @param UniqueLoneDog\Models\User $user
     */
    public function createRememberCookie(User $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token     = sha1($user->email . $user->password . $userAgent);

        $remember            = new RememberToken();
        $remember->usersId   = $user->id;
        $remember->token     = $token;
        $remember->userAgent = $userAgent;

        if ($remember->save() != false) {
            $expire = time() + 86400 * 7;
            $this->cookies->set(self::USER, $user->id, $expire);
            $this->cookies->set(self::TOKEN, $token, $expire);
        }
    }

    /**
     * Check if the session has a remember me cookie
     *
     * @return boolean
     */
    public function exists()
    {
        return $this->cookies->has(self::USER);
    }

    /**
     * Try to login using the token in the cookie
     *
     * @return Phalcon\Http\Response
     */
    public function login()
    {
        $userId      = $this->cookies->get(self::USER)->getValue();
        $cookieToken = $this->cookies->get(self::TOKEN)->getValue();

        $currentUserToken = $this->getToken($userId);

        if ($this->isValidToken($userId, $currentUserToken, $cookieToken)) {

            $this->identity->setByUserId($userId);

            return $this->response->redirect('users');
        }

        $this->cookies->get(self::USER)->delete();
        $this->cookies->get(self::TOKEN)->delete();

        return $this->response->redirect('session/login');
    }

    private function getToken($userId)
    {
        $user = Users::findFirstById($userId);
        if (!$user) {
            return null;
        }

        $userAgent = $this->request->getUserAgent();
        return sha1($user->email . $user->passhash . $userAgent);
    }

    private function isValidToken($userId, $userToken, $cookieToken)
    {
        if ($userToken !== $cookieToken) {
            return false;
        }

        $conditions = array(
            "uid"    => $userId,
            "token"  => $userToken,
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

    /**
     * Remove the remember me cookies
     */
    public function remove()
    {
        if ($this->cookies->has(self::TOKEN)) {
            $this->cookies->get(self::TOKEN)->delete();
        }
        if ($this->cookies->has(self::USER)) {
            $this->cookies->get(self::USER)->delete();
        }
    }

}
