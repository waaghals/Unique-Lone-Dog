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
     * Returns the name of the current identity
     *
     * @return string
     */
    public function getName()
    {
        return $this->getIdentity()['name'];
    }

    /**
     * Removes the user identity information from session and destroy remember me cookies
     */
    public function remove()
    {
        $this->remember->remove();

        $this->session->remove(self::SESSION_NAME);
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
        $identity = $this->session->get(self::SESSION_NAME);
        if (isset($identity['id'])) {

            $user = User::findFirstById($identity['id']);
            if (!$user) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return null;
    }

    private function setIdentity(User $user)
    {
        $this->session->set(self::SESSION_NAME, array(
            'id'   => $user->id,
            'name' => $user->name,
            'role' => $user->role->name
        ));
    }

}
