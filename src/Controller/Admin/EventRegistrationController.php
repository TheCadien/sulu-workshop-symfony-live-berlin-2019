<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Common\DoctrineListRepresentationFactory;
use App\Entity\EventRegistration;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sulu\Component\Rest\AbstractRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EventRegistrationController extends AbstractRestController implements ClassResourceInterface
{
    /**
     * @var DoctrineListRepresentationFactory
     */
    private $doctrineListRepresentationFactory;

    public function __construct(
        DoctrineListRepresentationFactory $doctrineListRepresentationFactory,
        ViewHandlerInterface $viewHandler,
        ?TokenStorageInterface $tokenStorage = null
    ) {
        $this->doctrineListRepresentationFactory = $doctrineListRepresentationFactory;

        parent::__construct($viewHandler, $tokenStorage);
    }

    public function cgetAction(int $eventId): Response
    {
        $listRepresentation = $this->doctrineListRepresentationFactory->createDoctrineListRepresentation(
            EventRegistration::RESOURCE_KEY,
            ['eventId' => $eventId]
        );

        return $this->handleView($this->view($listRepresentation));
    }
}
