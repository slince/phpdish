<?php

/*
 * This file is part of the phpdish/phpdish
 *
 * (c) Slince <taosikai@yeah.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPDish\Bundle\ChatBundle\Controller;

use FOS\MessageBundle\FormModel\NewThreadMessage;
use PHPDish\Bundle\ChatBundle\Form\Type\NewChatType;
use PHPDish\Bundle\ChatBundle\Message\Provider;
use PHPDish\Bundle\ResourceBundle\Controller\ResourceConfigurationInterface;
use PHPDish\Bundle\ResourceBundle\Controller\ResourceController;
use PHPDish\Bundle\UserBundle\Controller\ManagerTrait;
use PHPDish\Bundle\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class ChatsController extends ResourceController
{
    use ManagerTrait;

    /**
     * @var Provider
     */
    protected $provider;

    public function __construct(ResourceConfigurationInterface $configuration, Provider $provider)
    {
        parent::__construct($configuration);
        $this->provider = $provider;
    }

    /**
     * 收件箱
     * @Route("/chats/inbox", name="chat_inbox")
     * @param Request $request
     * @return Response
     */
    public function inboxAction(Request $request)
    {
        $threads = $this->provider->getInboxThreadsPager(
            $request->query->get('page', 1)
        );
        return $this->render($this->configuration->getTemplate('Chat:inbox.html.twig'), [
            'threads' => $threads
        ]);
    }

    /**
     * 发送箱
     *
     * @Route("/chats/sent", name="chat_sent")
     *
     * @param Request $request
     * @return Response
     */
    public function sentAction(Request $request)
    {
        $threads = $this->provider->getSentThreadsPager(
            $request->query->get('page', 1)
        );
        return $this->render($this->configuration->getTemplate('Chat:sent.html.twig'), [
            'threads' => $threads
        ]);
    }

    /**
     * 添加新的聊天
     *
     * @Route("/chats/new", name="chat_add")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $username = $request->query->get('mail_to');
        $user = $this->getUserManager()->findUserByName($username);

        if (is_null($user)) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(NewChatType::class, $this->createBlankThreadMessage($user));
        $formHandler = $this->get('fos_message.new_thread_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->get('router')->generate('fos_message_thread_view', [
                'threadId' => $message->getThread()->getId(),
            ]));
        }
        return $this->render($this->configuration->getTemplate('Chat:new_chat.html.twig'), array(
            'form' => $form->createView(),
            'recipient' => $user,
            'data' => $form->getData(),
        ));
    }

    protected function createBlankThreadMessage(UserInterface $user)
    {
        /**@var TranslatorInterface*/
        $translator = $this->get('translator');
        $threadMessage = new NewThreadMessage();
        $threadMessage->setRecipient($user);
        $threadMessage->setSubject($translator->trans('chat_with', [
            '%username%' => $user->getUsername()
        ]));
        return $threadMessage;
    }
}
