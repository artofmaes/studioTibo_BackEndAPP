<?php


namespace App\ApiPlatform;



use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Events;
use Doctrine\ORM\QueryBuilder;

class EventsFilter implements QueryItemExtensionInterface, QueryCollectionExtensionInterface
{

    private $currentDate;

    public function __construct()
    {
        $this->currentDate = new \DateTime(null, new \DateTimeZone('Europe/Brussels'));
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     */
    public function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void{
        if($resourceClass === Events::class){
            $rootalias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.event_end > :now', $rootalias))
                ->setParameter(':now', $this->currentDate);
        }
    }

}