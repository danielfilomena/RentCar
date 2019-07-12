var clienteController = new ClienteController();

//load
var body = document.querySelector("body");
body.onload = clienteController.CarregarClientes.bind(clienteController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", clienteController.salvar.bind(clienteController));

