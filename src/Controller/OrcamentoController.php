<?php

namespace App\Controller;

use App\Entity\Orcamento;
use App\Form\OrcamentoType;
use App\Repository\OrcamentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Servico;
use App\Entity\Cliente;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/orcamento')]
final class OrcamentoController extends AbstractController
{
    #[Route(name: 'app_orcamento_index', methods: ['GET'])]
    public function index(OrcamentoRepository $orcamentoRepository): Response
    {
        return $this->render('orcamento/index.html.twig', [
            'orcamentos' => $orcamentoRepository->findAll(),
        ]);
    }

    #[Route('/api', name: 'api_orcamento', methods: ['POST'])]
    public function criarOrcamento(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validação básica dos dados recebidos
        if (!isset($data['nome'], $data['contato'], $data['servico'], $data['qtd'], $data['valortotal'])) {
            return new JsonResponse(['error' => 'Dados incompletos'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Criar e persistir o Cliente (se necessário)
        $cliente = new Cliente();
        $cliente->setNome($data['nome']);
        $cliente->setContato($data['contato']);
        $entityManager->persist($cliente);

        // Buscar o serviço correspondente
        $servico = $entityManager->getRepository(Servico::class)->find($data['servico']);

        if (!$servico) {
            return new JsonResponse(['error' => 'Serviço não encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Criar o orçamento
        $orcamento = new Orcamento();
        $orcamento->setIdCliente($cliente);
        $orcamento->setIdServico($servico);
        $orcamento->setQtd((float) $data['qtd']);
        $orcamento->setValorTotal((float) $data['valortotal']);

        // Persistindo no banco de dados
        $entityManager->persist($orcamento);
        $entityManager->flush();

        // Retornando resposta JSON com sucesso
        return new JsonResponse([
            'message' => 'Orçamento registrado com sucesso!',
            'id' => $orcamento->getId()
        ], JsonResponse::HTTP_CREATED);
    }

    #[Route('/new', name: 'app_orcamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orcamento = new Orcamento();
        $form = $this->createForm(OrcamentoType::class, $orcamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orcamento);
            $entityManager->flush();

            return $this->redirectToRoute('app_orcamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('orcamento/new.html.twig', [
            'orcamento' => $orcamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orcamento_show', methods: ['GET'])]
    public function show(Orcamento $orcamento): Response
    {
        return $this->render('orcamento/show.html.twig', [
            'orcamento' => $orcamento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_orcamento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Orcamento $orcamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrcamentoType::class, $orcamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_orcamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('orcamento/edit.html.twig', [
            'orcamento' => $orcamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orcamento_delete', methods: ['POST'])]
    public function delete(Request $request, Orcamento $orcamento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orcamento->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($orcamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_orcamento_index', [], Response::HTTP_SEE_OTHER);
    }
}
