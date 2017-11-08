<?php

namespace Azine\EmailBundle\Entity\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * SentEmailRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SentEmailRepository extends EntityRepository
{
    /**
     * Search SentEmails by search params.
     * @param $searchParams
     * @return array of SentEmail
     */
    public function search($searchParams = [])
    {
        $queryBuilder = $this->createQueryBuilder('e');

        if (!empty($searchParams)) {

            $searchAttributes = [
                'recipients',
                'template',
                'sent',
                'variables',
                'token'
            ];

            foreach ($searchAttributes as $attribute) {
                if (empty($searchParams[$attribute])) {
                    continue;
                }

                $attributeValue = $searchParams[$attribute];

                $queryBuilder->andWhere('e.'.$attribute.' LIKE :'.$attribute)
                    ->setParameter($attribute, '%'.$attributeValue.'%');
            }
        }

        $sentEmails = $queryBuilder->getQuery()->getResult();
        return $sentEmails;
    }
}
