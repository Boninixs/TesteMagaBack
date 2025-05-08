<?php
require_once __DIR__ . '/../../config/conexao.php';

use Teste\Magazord\Model\Contato;
use Teste\Magazord\Model\Pessoa;

header('Content-Type: application/json; charset=utf-8');

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'listar':
        $idpessoa = $_GET['idpessoa'];
        $contatos = $entityManager->getRepository(Contato::class)->findBy(['idpessoa' => $idpessoa]);
        
        $dados = array_map(function($contato) {
            return [
                'idcontato' => $contato->getIdcontato(),
                'tipocontato' => $contato->getTipocontato(),
                'descricaocontato' => $contato->getDescricaocontato(),
                'idpessoa' => $contato->getIdpessoa() ? $contato->getIdpessoa()->getIdpessoa() : null,
            ];
        }, $contatos);
        echo json_encode($dados);
        break;

    case 'buscar':
        $id = $_GET['idcontato'];
        $contato = $entityManager->find(Contato::class, $id);
        if ($contato) {
            echo json_encode([
                'idcontato' => $contato->getIdcontato(),
                'tipocontato' => $contato->getTipocontato(),
                'descricaocontato' => $contato->getDescricaocontato(),
                'idpessoa' => $contato->getIdpessoa() ? $contato->getIdpessoa()->getIdpessoa() : null,
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
        }
        break;

    case 'inserir':
        $idpessoa = $_POST['idpessoa'];
        $tipo = $_POST['tipocontato'];
        $descricao = $_POST['descricaocontato'];
    
        $pessoa = $entityManager->find(Pessoa::class, $idpessoa);
    
        if ($pessoa) {
            $contato = new Contato();
            $contato->setTipocontato($tipo);
            $contato->setDescricaocontato($descricao);
            
            $contato->setPessoa($pessoa); 
    
            $entityManager->persist($contato);
            $entityManager->flush();
    
            echo json_encode(['status' => 'success', 'id' => $contato->getIdcontato()]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Pessoa não encontrada']);
        }
        break;
        

    case 'alterar':
        $id = $_POST['idcontato'];
        $tipo = $_POST['tipocontato'];
        $descricao = $_POST['descricaocontato'];

        $contato = $entityManager->find(Contato::class, $id);
        if ($contato) {
            $contato->setTipocontato($tipo);
            $contato->setDescricaocontato($descricao);
            $entityManager->flush();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
        }
        break;

    case 'excluir':
        $id = $_POST['idcontato'];
        $contato = $entityManager->find(Contato::class, $id);
        if ($contato) {
            $entityManager->remove($contato);
            $entityManager->flush();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
        break;
}
?>
