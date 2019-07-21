<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/5/18
 * Time: 11:17 AM
 */

namespace Cottect\Services\User;

use Cottect\Entity\Country;
use Cottect\Services\Sms\SmsSenderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserRegisterByPhoneService extends UserRegisterService
{
    protected $phone;

    /**
     * @var Country
     */
    protected $country;

    /**
     * @var SmsSenderService
     */
    protected $senderService;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator,
        UserPasswordEncoderInterface $passwordEncoder,
        SmsSenderService $senderService
    )
    {
        parent::__construct($entityManager, $translator, $passwordEncoder);
        $this->senderService = $senderService;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function submit()
    {
        $request = $this->getRegisterRequest();
        $this->setPhone($request->getUsername());
        $user = $this->userRepository->createByPhone(
            $request->getFirstName(),
            $request->getLastName(),
            $this->getPhone(),
            $request->getPassword(),
            $request->getBirthday(),
            $request->getGender(),
            $this->getVerifyCode()
        );

        return $user;
    }

    private function sendVerifyCode()
    {
        $this->senderService->setPhone($this->getPhone());
        $countryCode = $this->country->getPhoneNumberCode() ? $this->country->getPhoneNumberCode() : 84;
        $this->senderService->setCountryCode($countryCode);
        $this->senderService->send($this->getVerifyCode());
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }
}
