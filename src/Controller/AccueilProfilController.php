<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilProfilController extends AbstractController
{
    #[Route('/accueil/profil', name: 'app_accueil_profil')]
    public function index(): Response
    {
        $user = $this->getUser();

        if ($user->isRenouvelerMdp()) {
            return $this->redirectToRoute('app_forced_mdp');
        }

        $id_user = $this->getUser()->getId();

        return $this->render('accueil_profil/index.html.twig', [
            'controller_name' => 'AccueilProfilController',
            'id_user' => $id_user
        ]);
    }

    #[Route('/reservation/{id_user}', name: 'app_reservation_user')]
    public function getReservation(ReservationRepository $reservationRepository): Response
    {
        $id_user = $this->getUser()->getId();

        $reservations = $reservationRepository->getReservationByIdUser($id_user);






        return $this->render('accueil_profil/reservation.html.twig', [
            'controller_name' => 'AccueilProfilController',
            'reservations' => $reservations
        ]);
    }
}
