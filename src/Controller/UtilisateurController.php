<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UtilisateurType;
class UtilisateurController extends AbstractController
{ 
    

    
    #[Route('/dashboard/utilisateurs', name: 'app_user_index')]
    public function utilisateurindex(UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le nombre total de participants
        $participantCount = $entityManager->getRepository(Utilisateur::class)
            ->count(['Role' => 'Participant']);
    
        // Récupérer le nombre total d'organisateurs
        $organisateurCount = $entityManager->getRepository(Utilisateur::class)
            ->count(['Role' => 'Organisateur']);
    
        // Récupérer tous les utilisateurs
        $utilisateurs = $utilisateurRepository->findAll();
    
        // Passer les données à la vue
        return $this->render('back/utilisateur/Utilisateur.html.twig', [
            'utilisateurs' => $utilisateurs,
            'participantCount' => $participantCount,
            'organisateurCount' => $organisateurCount,
        ]);
    }
    

    #[Route('/dashboard/utilisateur/show/{CIN}', name: 'app_user_show')]
    public function show(int $CIN, UtilisateurRepository $utilisateurRepository): Response
    {
        $utilisateur = $utilisateurRepository->find($CIN);
    
        if (!$utilisateur) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
    
        return $this->render('back/utilisateur/ShowUtilisateur.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }
    

    #[Route('/dashboard/utilisateur/edit/{CIN}', name: 'app_user_edit')]
    public function edit(Utilisateur $utilisateur): Response
    {
        // Tu ajouteras ici ton formulaire d'édition
        return $this->render('user/edit.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/dashboard/utilisateur/delete/{CIN}', name: 'app_user_delete')]
    public function delete(int $CIN, UtilisateurRepository $utilisateurRepository, EntityManagerInterface $em): Response
    {
        // Trouver l'utilisateur par son CIN
        $user = $utilisateurRepository->find($CIN);
    
        // Si l'utilisateur n'existe pas, afficher une erreur (par exemple, redirection avec message d'erreur)
        if (!$user) {
            $this->addFlash('error', 'Utilisateur introuvable.');
            return $this->redirectToRoute('app_user_index');
        }
    
        // Suppression de l'utilisateur
        $em->remove($user);
        $em->flush();
    
        // Redirection vers la liste des utilisateurs
        return $this->redirectToRoute('app_user_index');
    }
    

 

    #[Route('/dashboard/utilisateur/ajouter', name: 'app_user_new')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        // Créer une nouvelle instance de l'utilisateur
        $utilisateur = new Utilisateur();

        // Créer le formulaire
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder l'utilisateur dans la base de données
            $em->persist($utilisateur);
            $em->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'Utilisateur ajouté avec succès.');

            // Rediriger vers la liste des utilisateurs
            return $this->redirectToRoute('app_user_index');
        }

        // Afficher le formulaire
        return $this->render('back/utilisateur/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
