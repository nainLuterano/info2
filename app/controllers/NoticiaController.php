<?php
use Phalcon\Mvc\Url;
use App\Models\Noticia;
use Noticia as GlobalNoticia;
use Categoria as GlobalCategoria;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';


    public function listaJsonAction()
    {
        $this->view->disable();
        $noticias = new GlobalNoticia();

        $response = new \Phalcon\Http\Response();

        $noticias = $noticias->find();

        $url = new Url();

        return $response->setContent(json_encode([
            'noticias' => $noticias,
            'url_update'  => 'noticias/editar/',
            'url_excluir' => 'noticias/excluir/'
        ]));

    }

    public function listaAction()
    {
        $noticias = new GlobalNoticia();

        $this->view->setVar('noticias', $noticias->find());

        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $this->view->setVar('categorias', GlobalCategoria::find() );
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        
        $this->view->setVar('noticia', GlobalNoticia::findFirst($id));
        $this->view->setVar('categorias', GlobalCategoria::find() );

        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {


        if ( $this->request->getPost('id') ) {

            $categoriaNoticia = new CategoriaNoticia();
            $categoriaNoticia->findFirst(['id_noticia' => $this->request->getPost('id')])->delete();

            $noticia = GlobalNoticia::findFirst(
                $this->request->getPost('id')
            );
            
            $statusCadastroNoticia = $noticia->update($this->request->getPost(), ['titulo','texto','data_publicacao']);
            $statusCadastroCategoria =  $this->cadastrarCategorias(
                $this->request->getPost('categorias'),
                $this->request->getPost('id')
            );
            
            if ( $statusCadastroCategoria && $statusCadastroNoticia  ) {
                $this->flash->success('Not??cia atualizada com sucesso');
            } else {
                $this->flash->error('Erro ao atualizar a not??cia!');
            }


            return $this->response->redirect(array('for' => 'noticia.lista'));
        } 

        $noticia = new GlobalNoticia();
        $statusCadastroNoticia =  $noticia->save($this->request->getPost());
        $statusCadastroCategoria = $this->cadastrarCategorias(
            $this->request->getPost('categorias'),
            $noticia->getId()
        );

        if ( $statusCadastroNoticia && $statusCadastroCategoria  ) {
            $this->flash->success('Not??cia cadastrada com sucesso');
        } else {
            $this->flash->error('Erro ao cadastrar a not??cia!');
        }

        
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

     public function excluirAction($id)
     {
         $noticia = GlobalNoticia::find($id);

         if ( $noticia->delete() ) {
            $this->flash->success('Not??cia deletada com sucesso');
        } else {
            $this->flash->error('Erro ao deletar a not??cia!');
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

     private function cadastrarCategorias($id_categorias, $id_noticia) {
        
        foreach ($id_categorias as $id ) {
            $categoriaNoticia = new CategoriaNoticia();
            $status = $categoriaNoticia->save(
                ['id_noticia'=> $id_noticia,
                 'id_categoria'=> $id]
            );

            if ( !$status ) {
                break;
            }
        }

        return $status;
     }
}