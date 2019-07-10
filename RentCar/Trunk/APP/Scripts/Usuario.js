var usuarioController = new UsuarioController();

//load
var body = document.querySelector("body");
body.onload = usuarioController.CarregarUsuarios.bind(usuarioController);

//salvar
var form = document.querySelector('#formulario');
form.addEventListener("submit", usuarioController.salvar.bind(usuarioController));

