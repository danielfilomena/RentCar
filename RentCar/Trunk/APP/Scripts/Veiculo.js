var veiculoController = new VeiculoController();

//load
var body = document.querySelector("body");
body.onload = veiculoController.CarregarVeiculos.bind(veiculoController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", veiculoController.salvar.bind(veiculoController));

