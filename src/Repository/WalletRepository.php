<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Wallet;
use App\Entity\XUserWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wallet>
 */
class WalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallet::class);
    }

    //    /**
    //     * @return Wallet[] Returns an array of Wallet objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
    public function findWalletsForUser(User $user): array
    {
        $query = $this
            ->createQueryBuilder('w')
            ->innerJoin(XUserWallet::class, 'xuw', 'WITH', 'xuw.wallet = w AND xuw.is_deleted = false AND xuw.target_user_id = :user')
            ->andWhere('wallet.is_deleted = false')
            ->setParameter('user', $user);

        return $query->getQuery()->getResult();
    }
}
