<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use App\Forms\UserType;
use App\Forms\RegistrationType;


/**
 * Class SecurityController
 *
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            try{
                /** @var User $sdkUser */
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            } catch(\Exception $exception){
                $this->addFlash('warning', 'Bei der Registrierung ist etwas schiefgelaufen. Versuchen Sie es später erneut.' . $exception->getMessage());

                return $this->render('Security/register.html.twig', [
                    'form' => $form->createView()
                ]);
            }

            $this->addFlash('success', 'Willkommen bei Roundabout. Sie haben sich erfolgreich registriert.');

            return $this->redirectToRoute('feed');
        }

        return $this->render('Security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return RedirectResponse|Response
     */
    public function loginAction()
    {
        return $this->render('Security/login.html.twig');
    }

    /**
     * @param Request  $request
     *
     * @param Security $security
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Request $request, Security $security)
    {
        $user = $security->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            try{
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            }catch(\Exception $exception){
                $this->addFlash("warning", "Etwas ist schiefgelaufen. Versuchen Sie es später erneut.");

                return $this->render("User/userForm.html.twig", [
                    'form' => $form->createView(),
                    'user' => $user
                ]);
            }

            $this->addFlash("success", "Sie haben Ihr Profil erfolgreich aktualisiert.");

            return $this->redirectToRoute('feed');
        }

        return $this->render("User/userForm.html.twig", [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function forgotPasswordAction(Request $request)
    {
        if($request->isMethod(Request::METHOD_POST))
        {
            $emailAddress = strip_tags($request->get('_email'));
            $password = $this->generatePassword($emailAddress);
            $user = '';
            $user->setPlainPassword($password);

            try{
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            }catch(\Exception $exception){
                $this->addFlash('warning', "Irgendetwas ist schiefgelaufen, bitte versuchen Sie es später erneut.");

                return $this->render('Security/forgotpassword.html.twig');
            }

            $this->addFlash('success', "Ein neues Passwort wurde generiert. Bitte schauen Sie in Ihrem Mail Postfach.");

            return $this->redirectToRoute('login');
        }

        return $this->render('Security/forgotpassword.html.twig');
    }

    /**
     * @param string $username
     *
     * @return bool|string
     */
    private function generatePassword(string $username)
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($data), 0, strlen($username));
    }

}