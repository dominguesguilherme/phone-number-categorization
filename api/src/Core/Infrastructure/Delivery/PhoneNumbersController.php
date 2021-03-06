<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Infrastructure\Delivery;

use PhoneNumberCategotization\Core\Application\CreateUser;
use PhoneNumberCategotization\Core\Application\FetchCategorizedPhoneNumbers;
use PhoneNumberCategotization\Framework\Id\Domain\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

use function assert;
use function is_array;

class PhoneNumbersController extends AbstractController
{
    /**
     * @Route("/phone-numbers", methods={"GET"})
     */
    public function list(Request $request, MessageBusInterface $bus): Response
    {
        $code = $request->query->get('code', null);
        $state = $request->query->get('state', null);
        $command = new FetchCategorizedPhoneNumbers($code, $state);

        $result = $bus->dispatch($command);

        $handled = $result->last(HandledStamp::class);
        assert($handled instanceof HandledStamp);

        $phoneNumbers = $handled->getResult();
        assert(is_array($phoneNumbers));

        return new JsonResponse($phoneNumbers);
    }
}
