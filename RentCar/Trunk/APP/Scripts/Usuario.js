var usuarioController = new UsuarioController();

var body = document.querySelector("body");
body.onload = usuarioController.CarregarUsuarios.bind(usuarioController);

var form = document.querySelector('#formulario');
form.addEventListener("submit", usuarioController.salvar.bind(usuarioController));