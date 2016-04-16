<?php

namespace Pimterest\AppBundle\Controller;

use Pimterest\AppBundle\Entity\Contribution;
use Pimterest\AppBundle\Repository\ContributionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocationsController extends Controller
{
    public function listAction()
    {
        $contributations = $this->getContribRepo()->findAll();
        $locations = [];

        /** @var Contribution $contrib */
        foreach($contributations as $contrib) {
            if ($contrib->getLatitude()) {
                $locations[] = [
                    'content' => trim($contrib->getContent()),
                    'media' => $contrib->getMediaUrl(),
                    'position' => [
                        'lat' => (float) $contrib->getLatitude(),
                        'lng' => (float) $contrib->getLongitude()
                    ],
                    'userType' => $contrib->getUserType(),
                ];
            }
        }

        return new JsonResponse($locations);
    }

    /**
     * @return ContributionRepository
     */
    public function getContribRepo()
    {
        return $this->container->get('pimterest.repository.contribution');
    }
}
