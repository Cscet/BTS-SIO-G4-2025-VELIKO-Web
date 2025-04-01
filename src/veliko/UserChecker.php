<?php
namespace App\veliko;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }
        if (!$user->isVerified()) {
            throw new CustomUserMessageAuthenticationException(
                'ton compte n\'est pas encore vérifié, veuillez vérifier votre boîte mail.'
            );
        }
        if ($user->IsBlocked()) {
            throw new CustomUserMessageAuthenticationException(
                'ton compte est bloqué, veuillez contacter l\'administrateur.'
            );
        }

    }
    public function checkPostAuth(UserInterface $user): void
    {
        $this->checkPreAuth($user);

        // Mettre à jour la date de dernière connexion
        $user->setConnexion(new \DateTime());

        // Enregistrer dans la base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}