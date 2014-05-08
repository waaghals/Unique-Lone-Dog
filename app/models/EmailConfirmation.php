<?php

namespace UniqueLoneDog\Models;

class EmailConfirmation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $confirmationCode;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     *
     * @var integer
     */
    public $modifiedAt;

    /**
     *
     * @var string
     */
    public $confirmed;

    public function getSource()
    {
        return 'email_confirmation';
    }

    /**
     * Assign a password before user creation
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();

        // Generate a random confirmation code
        $randomData = base64_encode(openssl_random_pseudo_bytes(24));
        $code = preg_replace('/[^a-zA-Z0-9]/', '', $randomData);
        $this->confirmationCode = $code;

        // Set status to non-confirmed
        $this->confirmed = 'N';
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate()
    {
        // Timestamp the confirmaton
        $this->modifiedAt = time();
    }

    public function initialize()
    {
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id');
    }

}
