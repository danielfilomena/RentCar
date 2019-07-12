var reservaController = new ReservaController();

//load
var body = document.querySelector("body");
body.onload = reservaController.CarregarReservas.bind(reservaController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", reservaController.salvar.bind(reservaController));

