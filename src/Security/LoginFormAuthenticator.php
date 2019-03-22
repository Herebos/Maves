<?php

namespace App\Security;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    //used to go to previous page if need login
    use TargetPathTrait;

    private $userRepository;

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserRepository $userRepository, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'app_login' && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        //set last_username as username (for error purpose)
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['username']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //create new Token and check if valid
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        return $this->userRepository->findOneBy(['username' =>$credentials['username']]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        //if true: you can go /// if false: stop right there you criminal scum
        //check password later -> erase return true;
        //return true;
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        //if a target(page) is stored in the session, go there after login
//        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
//            return new  RedirectResponse($targetPath);
//        }

        $roles = $token->getRoles();

        //Get role in array
        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);


        //Check array for role, redirect depending on ROLE_
        if(in_array('ROLE_ADMIN', $rolesTab, true)) {
            $url = 'app_admin_dashboard';
        }
        elseif (in_array('ROLE_USER', $rolesTab, true)) {
            $url = 'app_profil';
        } else {
            $url = "app_index";
        }

//        if($roles == "ROLE_ADMIN") {
//            $url = 'app_admin_dashboard';
//        }
//        elseif ($roles == "ROLE_USER") {
//            $url = 'app_profil';
//        } else {
//            $url = "app_index";
//        }

        //default fallback after login
        //if ()
        return new RedirectResponse($this->router->generate($url));
    }


    /**
     * Return the URL to the login page.
     *
     * @return string
     */
    protected function getLoginUrl()
    {
        //url to redirect if submit is false
        return $this->router->generate('app_login');
    }
}
