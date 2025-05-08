<?php
require_once __DIR__ . '/../../config/conexao.php';

use Teste\Magazord\Model\Pessoa;

header('Content-Type: application/json; charset=utf-8');  // Sempre definir JSON

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'listar':
        $pessoas = $entityManager->getRepository(Pessoa::class)->findAll();
        $dados = array_map(function($pessoa) {
            return [
                'idpessoa' => $pessoa->getIdpessoa(),
                'nomepessoa' => $pessoa->getNomepessoa(),
                'cpfpessoa' => $pessoa->getCpfpessoa(),
            ];
        }, $pessoas);
        echo json_encode($dados);
        break;

    case 'buscar':
        $id = $_GET['idpessoa'] ?? null;
        $pessoa = $entityManager->find(Pessoa::class, $id);
        if ($pessoa) {
            echo json_encode([
                'idpessoa' => $pessoa->getIdpessoa(),
                'nomepessoa' => $pessoa->getNomepessoa(),
                'cpfpessoa' => $pessoa->getCpfpessoa(),
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Pessoa não encontrada']);
        }
        break;

    case 'inserir':
    
        $nome = $_POST['nomepessoa'] ?? '';
        $cpf = $_POST['cpfpessoa'] ?? '';

        $pessoa = new Pessoa();
        $pessoa->setNomepessoa($nome);
        $pessoa->setCpfpessoa($cpf);

        $entityManager->persist($pessoa);
        $entityManager->flush();

        echo json_encode(['status' => 'success', 'id' => $pessoa->getIdpessoa()]);
        break;

    case 'alterar':
        $id = $_POST['idpessoa'] ?? null;
        $nome = $_POST['nomepessoa'] ?? '';
        $cpf = $_POST['cpfpessoa'] ?? '';

        $pessoa = $entityManager->find(Pessoa::class, $id);
        if ($pessoa) {
            $pessoa->setNomepessoa($nome);
            $pessoa->setCpfpessoa($cpf);
            $entityManager->flush();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Pessoa não encontrada']);
        }
        break;

    case 'excluir':
        $id = $_POST['idpessoa'] ?? null;
        $pessoa = $entityManager->find(Pessoa::class, $id);
        if ($pessoa) {
            $entityManager->remove($pessoa);
            $entityManager->flush();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Pessoa não encontrada']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
        break;
}