<?php
namespace App\Controller\Admin;

use App\Repository\HabitRepository;
use Mns\Buggy\Core\AbstractController;

class HabitsController extends AbstractController
{
    private HabitRepository $habitRepository;

    public function __construct()
    {
        $this->habitRepository = new HabitRepository();
    }

	/**
     * Liste les habitudes de tous les utilisateurs
     */
    public function index()
    {
        $habits = $this->habitRepository->findAll();

        return $this->render('admin/habits/index.html.php', [
            'habits' => $habits,
        ]);
    }
}
