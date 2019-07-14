var locacaoController = new LocacaoController();

//load
var body = document.querySelector("body");
body.onload = locacaoController.CarregarLocacoes.bind(locacaoController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", locacaoController.salvar.bind(locacaoController));

