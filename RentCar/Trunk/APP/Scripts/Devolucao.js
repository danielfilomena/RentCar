var devolucaoController = new DevolucaoController();

//load
var body = document.querySelector("body");
body.onload = devolucaoController.CarregarDevolucoes.bind(devolucaoController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", devolucaoController.salvar.bind(devolucaoController));

