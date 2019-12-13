<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

/**
 * Class Authenticator
 *
 * @author Philip Maass <pmaass@databay.de>
 */
class Authenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /**
     * @var AuthenticationSuccessHandlerInterface
     */
    private $successHandler;

    /**
     * @var AuthenticationFailureHandlerInterface
     */
    private $failureHandler;

    /**
     * @var string
     */
    private $loginUrl;

    /**
     * Authenticator constructor.
     *
     * @param DefaultAuthenticationSuccessHandler $successHandler
     * @param DefaultAuthenticationFailureHandler $failureHandler
     * @param string                              $loginUrl
     */
    public function __construct(
        DefaultAuthenticationSuccessHandler $successHandler,
        DefaultAuthenticationFailureHandler $failureHandler,
        string $loginUrl

    )
    {
        $this->successHandler = $successHandler;
        $this->failureHandler = $failureHandler;
        $this->loginUrl       = $loginUrl;

    }

    /**
     * @inheritDoc
     */
    protected function getLoginUrl()
    {
        return $this->loginUrl;
    }

    /**
     * @inheritDoc
     */
    public function supports(Request $request)
    {
        return $request->get('_route') === 'login' && $request->isMethod(Request::METHOD_POST);
    }

    /**
     * @inheritDoc
     */
    public function getCredentials(Request $request)
    {
        return [
            "username" => $request->get('_username'),
            "password" => $request->get('_plainPassword'),
        ];

    }

    /**
     * @inheritDoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    /**
     * @inheritDoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
       return true;
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return $this->successHandler->onAuthenticationSuccess($request, $token);
    }

    /**
     * @param Request                 $request
     * @param AuthenticationException $exception
     *
     * @return RedirectResponse|Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->getFlashBag()->add('warning', $exception->getMessage());

        return $this->failureHandler->onAuthenticationFailure($request, $exception);
    }

}