<?php

require_once(__DIR__ . "/../model/Aluno.php");

class AlunoService {

    public function validar(Aluno $aluno) {
        $erros = array();

        if(! $aluno->getNome())
            array_push($erros, "Informe o nome!");
        
        if(! $aluno->getIdade())
            array_push($erros, "Informe a idade!");

        if(! $aluno->getEstrangeiro())
            array_push($erros, "Informe se o aluno é estrangeiro!");

        if(! $aluno->getCurso()->getId())
            array_push($erros, "Informe o curso!");
        
        return $erros;
    }

    public function excluir($id) {
        //valida o id
        if(! is_numeric($id)) {
            throw new Exception("ID inválido!");
        }

        //exclui o aluno
        $alunoDao = new AlunoDAO();
        $alunoDao->excluir($id);
    }

}