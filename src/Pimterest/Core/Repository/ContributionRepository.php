<?php

namespace Pimterest\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author    Adrien Pétremann <adrien.petremann@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ContributionRepository extends EntityRepository
{
    public function findAllOrderedByDate()
    {
        $this->findBy([], ['id' => 'DESC']);
        $this->getEntityManager()->persist($contribution);
        $this->getEntityManager()->flush($contribution);
    }
}
