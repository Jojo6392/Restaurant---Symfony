<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneDeCommande;
use App\Form\LigneDeCommandeType;
use App\Repository\LigneDeCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne/de/commande')]
class LigneDeCommandeController extends AbstractController
{
    #[Route('/', name: 'ligne_de_commande_index', methods: ['GET'])]
    public function index(LigneDeCommandeRepository $ligneDeCommandeRepository): Response
    {
        return $this->render('ligne_de_commande/index.html.twig', [
            'ligne_de_commandes' => $ligneDeCommandeRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'ligne_de_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Commande $commande): Response
    {
        $ligneDeCommande = new LigneDeCommande();
        $form = $this->createForm(LigneDeCommandeType::class, $ligneDeCommande, array(
            'id' => $commande->getRestaurant()->getId()
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ligneDeCommande->setCommande($commande);

            $entityManager->persist($ligneDeCommande);
            $entityManager->flush();

            return $this->redirectToRoute('ligne_de_commande_update_prix', array("id" => $ligneDeCommande->getCommande()->getId()), Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_de_commande/new.html.twig', [
            'ligne_de_commande' => $ligneDeCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ligne_de_commande_show', methods: ['GET'])]
    public function show(LigneDeCommande $ligneDeCommande): Response
    {
        return $this->render('ligne_de_commande/show.html.twig', [
            'ligne_de_commande' => $ligneDeCommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'ligne_de_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LigneDeCommande $ligneDeCommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LigneDeCommandeType::class, $ligneDeCommande, array(
            'id' => $ligneDeCommande->getCommande()->getRestaurant()->getId()
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ligne_de_commande_update_prix', array("id" => $ligneDeCommande->getCommande()->getId()), Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_de_commande/edit.html.twig', [
            'ligne_de_commande' => $ligneDeCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ligne_de_commande_delete', methods: ['POST'])]
    public function delete(Request $request, LigneDeCommande $ligneDeCommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligneDeCommande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ligneDeCommande);
            $entityManager->flush();
        }
        $user = $this->getUser();

        return $this->redirectToRoute('ligne_de_commande_update_prix', array("id" => $ligneDeCommande->getCommande()->getId()), Response::HTTP_SEE_OTHER);
    }

    #[Route('/updatePrix/{id}', name: 'ligne_de_commande_update_prix', methods: ['GET', 'POST'])]
    public function updatePrix(EntityManagerInterface $entityManager, Commande $commande): Response
    {
        $prixTotal = 0;
        if(!$commande) {
            throw $this->createNotFoundException(
                'Pas de commande trouvée avec cet id'
            );
        }
        foreach($commande->getLignesDeCommandes() as $ligne) {
            $quantite = $ligne->getQuantite();
            $prixProduit = $ligne->getProduit()->getPrix();
            $prixLigne = $quantite * $prixProduit;
            $prixTotal = $prixTotal + $prixLigne;
        }

        $commande->setPrix($prixTotal);

        $entityManager->flush();

        return $this->redirectToRoute('commande_show', array("id"=> $commande->getId()), Response::HTTP_SEE_OTHER);
    }
}
