<?php

namespace App\Controller;

use App\Entity\ItemBudget;
use App\Form\ItemBudgetType;
use App\Repository\ItemBudgetRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ventas/item_presupuesto")
 */
class ItemBudgetController extends AbstractController
{
    /**
     * @Route("/", name="app_item_budget_index", methods={"GET"})
     */
    public function index(ItemBudgetRepository $itemBudgetRepository): Response
    {
        return $this->render('item_budget/index.html.twig', [
            'item_budgets' => $itemBudgetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/prebudget", name="app_item_budget_prebudget", methods={"GET"})
     * @param ItemBudgetRepository $itemBudgetRepository
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function preBudget(ItemBudgetRepository $itemBudgetRepository, ProductRepository $productRepository): Response
    {

        return $this->render('item_budget/list-pre-budget.html.twig', [
            'item_budgets' => $itemBudgetRepository->findAll(),
            'products' => $productRepository->findBy(['isAvailable' => true, 'isForSale' => true])
        ]);
    }

    /**
     * @Route("/new", name="app_item_budget_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ItemBudgetRepository $itemBudgetRepository): Response
    {
        $itemBudget = new ItemBudget();
        $form = $this->createForm(ItemBudgetType::class, $itemBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itemBudgetRepository->add($itemBudget, true);

            return $this->redirectToRoute('app_item_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('item_budget/new.html.twig', [
            'item_budget' => $itemBudget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_item_budget_show", methods={"GET"})
     */
    public function show(ItemBudget $itemBudget): Response
    {
        return $this->render('item_budget/show.html.twig', [
            'item_budget' => $itemBudget,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_item_budget_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ItemBudget $itemBudget, ItemBudgetRepository $itemBudgetRepository): Response
    {
        $form = $this->createForm(ItemBudgetType::class, $itemBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itemBudgetRepository->add($itemBudget, true);

            return $this->redirectToRoute('app_item_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('item_budget/edit.html.twig', [
            'item_budget' => $itemBudget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_item_budget_delete", methods={"POST"})
     */
    public function delete(Request $request, ItemBudget $itemBudget, ItemBudgetRepository $itemBudgetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemBudget->getId(), $request->request->get('_token'))) {
            $itemBudgetRepository->remove($itemBudget, true);
        }

        return $this->redirectToRoute('app_item_budget_index', [], Response::HTTP_SEE_OTHER);
    }
}
