<?php

use App\Models\Noticia;
use Noticia as GlobalNoticia;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';


    public function listaAction()
    {
        $noticias = new GlobalNoticia();

        $this->view->setVar('noticias', $noticias->find());

        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        $noticia = GlobalNoticia::findFirst($id);

        $this->view->setVar('noticia', $noticia);

        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {


        if ( $this->request->getPost('id') ) {

            $noticia = GlobalNoticia::findFirst(
                $this->request->getPost('id')
            );

            if ( $noticia->update($this->request->getPost(), ['titulo','texto']) ) {
                $this->flash->success('Notícia atualizada com sucesso');
            } else {
                $this->flash->error('Erro ao atualizar a notícia!');
            }
        } else {
            $noticia = new GlobalNoticia();
            if ( $noticia->save($this->request->getPost()) ) {
                $this->flash->success('Notícia cadastrada com sucesso');
            } else {
                $this->flash->error('Erro ao cadastrar a notícia!');
            }
        }
        
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

     public function excluirAction($id)
     {
         $noticia = GlobalNoticia::find($id);

         if ( $noticia->delete() ) {
            $this->flash->success('Notícia deletada com sucesso');
        } else {
            $this->flash->error('Erro ao deletar a notícia!');
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}