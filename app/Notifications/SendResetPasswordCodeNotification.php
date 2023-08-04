<?php

namespace App\Notifications;

use App\Notifications\Base\BaseNotification;

class SendResetPasswordCodeNotification extends BaseNotification
{

    protected array $disabledChannels = ['expo'];

    public function __construct(
        public readonly string $name,
        public readonly string $code,
    )
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function notification(): array
    {
        $name = $this->name;

        $message = "Hi ${name} \n Please enter the code below to reset your password, \n" . implode(' ', [
                'Your password reset code is:',
                $this->code
            ]);

        return [
            'subject' => "Your password reset code",
            'summary' => $message,
            'message' => $message
        ];
    }
}
