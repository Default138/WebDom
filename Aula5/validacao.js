
function validarFormulario() {
   // alert("Validando formulário...");

   //Pega os valores dos inputs
   var titulo = document.getElementById("titulo").value;
   var genero = document.getElementById("genero").value;
   var qtd_paginas = document.getElementById("qtd_paginas").value;
   var autor = document.getElementById("autor").value;

   alert("Título: " + titulo + "\nGênero: " + genero + "\nQuantidade de Páginas: " + qtd_paginas + "\nAutor: " + autor);
   
   //Validações
   if (titulo.trim() == "") {
        erros.push("O campo 'Título' é obrigatório.");
   }

   if (genero.trim() == "") {
        erros.push("O campo 'Gênero' é obrigatório.");
   }

   if (qtd_paginas.trim() == "") {
        erros.push("O campo 'Quantidade de Páginas' é obrigatório.");
   } else if (isNaN(qtd_paginas) || parseInt(qtd_paginas) <= 0) {
        erros.push("O campo 'Quantidade de Páginas' deve ser um número inteiro positivo.");
   }

   if (autor.trim() == "") {
        erros.push("O campo 'Autor' é obrigatório.");
    }

    if (erros.length > 0) {
        var 
    }
}