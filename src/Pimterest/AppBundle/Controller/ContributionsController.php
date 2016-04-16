<?php

namespace Pimterest\AppBundle\Controller;

use Pimterest\AppBundle\Entity\Contribution;
use Pimterest\AppBundle\Repository\ContributionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author    Adrien Pétremann <adrien.petremann@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ContributionsController extends Controller
{
    public function listAction(Request $request)
    {
        $page = $request->query->getInt('page', 1);
        $limit = 10;

        $contributions = $this->getRepository()->findBy([
            'userType' => 'community'
        ], ['id' => 'DESC'], $limit, (($page - 1) * $limit));

        $contributions = array_map(function($contrib) {
            /** @var Contribution $contrib */
            $data = $contrib->toArray();
            $data['authorlink'] = $this->getAuthorLink($contrib->getUsername(), $contrib->getSource());

            return $data;
        }, $contributions);

        return new JsonResponse($contributions);
    }

    protected function getAuthorLink($username, $source)
    {
        $urls = [
            'twitter'   => 'https://twitter.com/%s',
            'instagram' => 'https://instagram.com/%s',
            'community' => 'http://www.akeneo.com/'
        ];

        return sprintf($urls[$source], $username);
    }

    /**
     * @return ContributionRepository
     */
    protected function getRepository()
    {
        return $this->container->get('pimterest.repository.contribution');
    }
}
