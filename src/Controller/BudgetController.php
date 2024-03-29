<?php

namespace App\Controller;

use App\Entity\Budget;
use App\Entity\NroFactura;
use App\Form\BudgetType;
use App\Repository\BudgetRepository;
use App\Repository\NroFacturaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ventas/presupuesto")
 */
class BudgetController extends AbstractController
{
    /**
     * @Route("/", name="app_budget_index", methods={"GET"})
     */
    public function index(BudgetRepository $budgetRepository): Response
    {
        return $this->render('budget/index.html.twig', [
            'budgets' => $budgetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_budget_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BudgetRepository $budgetRepository, NroFacturaRepository $nroFacturaRepository): Response
    {
        $budget = new Budget();
        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $nroFactura = new NroFactura();

            $nroFacturaRepository->add($nroFactura, true);

            $budget->setNroBudget($nroFactura->getId());

            $budget->setNroFactura($nroFactura);
            $productos = $form->get('productos')->getData();
foreach ($productos as $producto){
    $budget->addProducto($producto);
}





            $budgetRepository->add($budget, true);

            $nroFactura->setBudget($budget);
            $nroFacturaRepository->add($nroFactura, true);
            if($this->isGranted('ROLE_SUPERVISOR_VENTAS')) {
                return $this->redirectToRoute('app_budget_index', [], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_budget_show', ['id' => $budget->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('budget/new.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_budget_show", methods={"GET"})
     */
    public function show(Budget $budget): Response
    {
        return $this->render('budget/show.html.twig', [
            'budget' => $budget,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_budget_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Budget $budget, BudgetRepository $budgetRepository): Response
    {
        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $budgetRepository->add($budget, true);

            return $this->redirectToRoute('app_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('budget/edit.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_budget_delete", methods={"POST"})
     */
    public function delete(Request $request, Budget $budget, BudgetRepository $budgetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$budget->getId(), $request->request->get('_token'))) {
            $budgetRepository->remove($budget, true);
        }

        return $this->redirectToRoute('app_budget_index', [], Response::HTTP_SEE_OTHER);
    }
}
