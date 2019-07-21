<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 10:19 AM
 */

namespace Cottect\Services\User;

use Cottect\Services\Mailer\MailerSenderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserRegisterByEmailService extends UserRegisterService
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var MailerSenderService
     */
    private $senderService;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator,
        UserPasswordEncoderInterface $passwordEncoder,
        MailerSenderService $senderService
    )
    {
        parent::__construct($entityManager, $translator, $passwordEncoder);
        $this->senderService = $senderService;
    }

    /**
     * @return \Cottect\Entity\User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function submit()
    {
        $request = $this->getRegisterRequest();
        $this->setEmail($request->getUsername());
        $user = $this->userRepository->createByEmail(
            $request->getFirstName(),
            $request->getLastName(),
            $this->getEmail(),
            $request->getPassword(),
            $request->getBirthday(),
            $request->getGender(),
            $this->getVerifyCode()
        );
        $this->sendVerifyCode();

        return $user;
    }

    private function sendVerifyCode()
    {
        $this->senderService->send(
            $this->getEmail(),
            $this->translator->trans('email.subject.verify_code'),
            [
                $this->translator->trans(
                    'email.body.verify',
                    [
                        'firstName' => $this->getRegisterRequest()->getFirstName(),
                        'lastName' => $this->getRegisterRequest()->getLastName(),
                        'emailAddress' => $this->getEmail(),
                        'authenticationCode' => $this->getVerifyCode(),
                    ]
                ),
                MailerSenderService::TEXT_HTML,
            ]
        );
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
}
