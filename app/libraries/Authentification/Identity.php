<?php

namespace UniqueLoneDog\Authentification;

use Phalcon\Mvc\User\Component;
use UniqueLoneDog\Models\User;

/**
 * Methods for getting the current logged in identity
 *
 * @author Patrick
 */
class Identity extends Component
{

    const SESSION_NAME = "identity";

    private $user;

    public function exists()
    {
        return $this->session->has(self::SESSION_NAME);
    }

    /**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get(self::SESSION_NAME);
    }

    /**
     * Removes the user identity information from session and destroy remember me cookies
     */
    public function remove()
    {
        $this->remember->remove();

        $this->user = null;
        $this->session->remove(self::SESSION_NAME);
    }

    /**
     * Set the ientity session by a user object
     * @param \UniqueLoneDog\Models\User $user
     */
    public function set(User $user)
    {
        return $this->setByEmail($user->email);
    }

    /**
     * Set the identity session by the user id
     *
     * @param int $id
     */
    public function setByUserId($id)
    {
        $user = User::findFirstById($id);
        if (!$user) {
            throw new Exception('The user does not exist');
        }

        $this->setIdentity($user);
    }

    /**
     * Set the identity session by the user email
     *
     * @param string $email
     */
    public function setByEmail($email)
    {
        $user = User::findFirstByEmail($email);
        if (!$user) {
            throw new Exception('The user does not exist');
        }

        $this->setIdentity($user);
    }

    /**
     * Set the identity session by the username
     *
     * @param string $name
     */
    public function setByName($name)
    {
        $user = User::findFirstByName($name);
        if (!$user) {
            throw new Exception('The user does not exist');
        }

        $this->setIdentity($user);
    }

    /**
     * Get the entity related to user in the active identity
     *
     * @return \UniqueLoneDog\Models\User
     */
    public function getUser()
    {
        if (is_null($this->user)) {
            if (!$this->exists()) {
                return null;
            }

            $identity = $this->session->get(self::SESSION_NAME);
            $user     = User::findFirstById($identity['id']);
        }
        return $user;
    }

    private function setIdentity(User $user)
    {
        $this->session->set(self::SESSION_NAME,
                            array(
            'id'   => $user->id,
            'name' => $user->name,
            'role' => $user->role->name
        ));
    }

    public function get($name)
    {
        $user = $this->getUser();
        if ($user) {
            switch ($name) {
                case "reputation":
                    return $user->getHumanReputation();
                case "name":
                    return $user->name;
                case "email":
                    return $user->email;
                case "role":
                    return $user->getRole();
                case "status":
                    return $user->statusName;
            }
        } elseif ($name == "role") {
            return "Guest";
        }
        return "";
    }

}
