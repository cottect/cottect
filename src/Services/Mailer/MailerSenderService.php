<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 3/10/18
 * Time: 9:05 PM
 */

namespace Cottect\Services\Mailer;

use Symfony\Component\Translation\TranslatorInterface;

class MailerSenderService
{
    const TEXT_HTML = 'text/html';
    const TEXT_PLAINTEXT = 'text/plaintext';

    private $mailer;

    protected $translator;

    public function __construct(\Swift_Mailer $mailer, TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
    }

    public function send($to, $subject, $body)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom(getenv('MAILER_USER'), getenv('SENDER_NAME'))
            ->setTo($to)
            ->setBody(
                (is_array($body) ? $body[0] : $body) . $this->translator->trans('email.signal'),
                (is_array($body) && isset($body[1]) ? $body[1] : self::TEXT_PLAINTEXT)
            );
        $this->mailer->send($message, $erros);
    }
}
