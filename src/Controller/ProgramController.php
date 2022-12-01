<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/show/{id}', requirements: ['id'=>'\d+'],methods: ['GET'], name: 'show')]
    public function show(Program $program, ProgramRepository $programRepository): Response
    {
        // $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    /*#[Route('/{programId}/seasons/{seasonId}',methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        // same as $program = $programRepository->find($id);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        if (!$program || !$seasonId) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }*/

    #[Route('/{program}/seasons/{season}',methods: ['GET'], name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {
        

        if (!$program || !$season) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            
            'season' => $season,
        ]);
    }

    #[Route('/{program}/season/{seasonId}/episode/{episodeId}',methods: ['GET'], name: 'episode_show')]
    //#[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeId' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
       
        return $this->render('program/episode_show.html.twig', [
            'episode' => $episode,
        ]);
    }
}
