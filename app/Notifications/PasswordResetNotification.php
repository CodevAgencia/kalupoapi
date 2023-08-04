<?php

namespace App\Notifications;

use App\Notifications\Base\BaseNotification;

class PasswordResetNotification extends BaseNotification
{

    protected array $disabledChannels = ['expo'];

    /**
     * Create a new notification instance.
     */
    public function __construct(public readonly string $name)
    {
        $this->summary = "You have reset password successfully";

        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function notification(): array
    {
        $name = $this->name;
        return [
            'subject' => $this->summary,
            'summary' => $this->summary,
            'message' => "Hi ${name} \n You have reset password successfully, \n Thank you for using our application!",
        ];
    }
}
