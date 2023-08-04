<?php

namespace App\Notifications\Base;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Expo\ExpoChannel;
use NotificationChannels\Expo\ExpoMessage;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

abstract class BaseNotification extends Notification implements ShouldQueue
{

    use Queueable;

    protected array $channels = [
        'mail' => 'mail',
        'sms' => TwilioChannel::class,
        'expo' => ExpoChannel::class,
        'database' => 'database',
    ];

    protected array $disabledChannels = [];

    /**
     * @var string Subject or notification title
     */
    protected string $subject;

    /**
     * @var string URL of view on app or web
     */
    protected string $url = '';

    /**
     * @var string Short summary for Push, SMS, or E-mail preview
     */
    protected string $summary;

    /**
     * @var string Longer description for E-mail or DB notification
     */
    protected string $message = '';

    public function __construct()
    {
        foreach ($this->notification() as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array Should return [subject => '', summary => '', message => '']
     */
    abstract public function notification(): array;

    /**
     * @return array Automagically determined channels
     */
    public function via($notifiable): array
    {
        $disabledChannels = $this->disabledChannels;
        return collect([
            'sms' => fn() => 10 === \strlen($notifiable->phone_number ?? ""),
            'expo' => fn() => \count($notifiable->devices ?? []) > 0,
            'mail' => true,
            'database' => true,
        ])->filter(function ($value, $key) use ($disabledChannels) {
            if (in_array($key, $disabledChannels, true)) {
                return false;
            }
            return \is_callable($value) ? $value() : $value;
        })
            ->map(fn($value, $key) => $this->channels[$key])
            ->toArray();
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->line($this->message)
            ->subject($this->subject);
    }

    public function toTwilio(): TwilioSmsMessage
    {
        return (new TwilioSmsMessage())
            ->content($this->summary);
    }

    public function toExpo(): ExpoMessage
    {
        return ExpoMessage::create()
            ->badge(1)
            ->enableSound()
            ->title($this->subject)
            ->body($this->summary)
            ->setJsonData(['url' => $this->url]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(): array
    {
        return $this->notification();
    }

}
