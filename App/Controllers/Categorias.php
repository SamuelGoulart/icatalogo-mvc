<?php
session_start();

use App\Core\Controller;

class Categorias extends Controller
{

    // lista todos os produtos
    public function index()
    {
        $categoriaModel = $this->model("Categoria");

        $dados = $categoriaModel->listarTodos();

        $this->view("categorias/index", $dados);
    }

    public function create()
    {

        $this->view("categorias/create");
    }

    public function store()
    {

        $erros =  $this->validaCampos();

        if (count($erros) > 0) {
            $_SESSION["erros"] = $erros;
            header("location: /categorias/create");
            exit();
        }

        $descricao = $_POST["descricao"];

        //instanciar o model
        $categoriaModel = $this->model("Categoria");

        //atribuir a descrição do $_POST ao model->descricao
        $categoriaModel->descricao = $descricao;

        //chamar a função de inserir
        if ($categoriaModel->inserir()) {
            $_SESSION["mensagem"] = "Categoria cadastrada com sucesso";
        } else {
            $_SESSION["mensagem"] = "Prolemas ao cadastrar categoria";
        }

        header("location: /categorias");
    }

    public function edit($id)
    {

        $categoriaModel = $this->model("Categoria");
        $categoriaModel = $categoriaModel->buscarPorId($id);

        if ($categoriaModel) {
            $this->view("categorias/edit", $categoriaModel);
        } else {
            $_SESSION["mensagem"] = "Problemas ao buscar categoria";
            header("location: /categorias");
        }
    }

    public function update($id)
    {

        $descricao = $_POST["descricao"];
        //instanciar o model
        $categoriaModel = $this->model("Categoria");
        //atribuir a descrição do $_POST ao model->descricao
        $categoriaModel->descricao = $descricao;
        $categoriaModel->id = $id;

        //chamar a função de inserir
        if ($categoriaModel->atualizar()) {
            $_SESSION["mensagem"] = "Categoria atualizada com sucesso";
            header("location: /categorias");
        } else {
            $_SESSION["mensagem"] = "Prolemas ao atulizar a categoria";
            header("location: /categorias");
        }
    }

    public function destroy($id)
    {

        $categoriaModel = $this->model("Categoria");
        $categoriaModel->id = $id;
        if ($categoriaModel->deletar()) {

            $_SESSION["mensagem"] = "Categoria deletada com sucesso";
        } else {

            $_SESSION["mensagem"] = "Problemas ao deletar categoria";
        }
        header("location: /categorias");
    }

    private function validaCampos()
    {
        $erros = [];

        if (!isset($_POST["descricao"]) || $_POST["descricao"] == "") {
            $erros[] = "O campo descrição é obrigatório";
        }

        return $erros;
    }
}
