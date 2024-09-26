<?php

declare(strict_types=1);

namespace Notes\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Notes\Form\NoteForm;
use Notes\Entity\Note;
use Doctrine\ORM\EntityManager;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;

class NoteController extends AbstractActionController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function allAction()
    {
        $notes = $this->entityManager->getRepository(Note::class)->findAll();
        return new ViewModel(['notes' => $notes]);
    }

    public function newAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);

        if (!$data) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_400);
            return new JsonModel(['error' => 'Invalid JSON']);
        }

        $form = new NoteForm();
        $form->setData($data);

        if ($form->isValid()) {
            $note = new Note();
            $note->exchangeArray($form->getData());

            $this->entityManager->persist($note);
            $this->entityManager->flush();

            return $this->redirect()->toRoute('notes', ['action' => 'all']);
        }

        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_400);
        return new JsonModel($form->getMessages());
    }

    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $note = $this->entityManager->getRepository(Note::class)->find($id);

        if (!$note) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_404);
            return new JsonModel(['error' => 'Note not found']);
        }

        return new ViewModel(['note' => $note]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $note = $this->entityManager->getRepository(Note::class)->find($id);

        if (!$note) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_404);
            return new JsonModel(['error' => 'Note not found']);
        }

        $data = json_decode($this->getRequest()->getContent(), true);

        if (!$data) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_400);
            return new JsonModel(['error' => 'Invalid input data']);
        }

        $form = new NoteForm();
        $form->bind($note);
        $form->setData($data);

        if ($form->isValid()) {
            $this->entityManager->flush();

            return $this->redirect()->toRoute('notes', ['action' => 'all']);
        }

        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_400);
        return new JsonModel($form->getMessages());
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $note = $this->entityManager->getRepository(Note::class)->find($id);

        if (!$note) {
            $response = new Response();
            $response->setStatusCode(Response::STATUS_CODE_404);
            return new JsonModel(['error' => 'Note not found']);
        }

        $this->entityManager->remove($note);
        $this->entityManager->flush();

        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        
        return $this->redirect()->toRoute('notes', ['action' => 'all']);
    }
}
