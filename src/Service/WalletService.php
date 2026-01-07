<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Wallet;
use App\Entity\XUserWallet;
use App\Repository\WalletRepository;

class WalletService
{
    private readonly WalletRepository $walletRepository;

    public function __construct()
    {
    }

    public function findWalletsForUser(User $user): array
    {
        return $this->walletRepository->findWalletsForUser($user);
    }

    public function getWalletsForUser(User $user, Wallet $wallet): null|xUserWallet
    {
        $xUserWallet = null;

        try {
            $xUserWallet = $this->getUserAccessOnWallet($user, $wallet);
        } catch (\Exeptions $e) {
        }
        return $xUserWallet;
    }
}
