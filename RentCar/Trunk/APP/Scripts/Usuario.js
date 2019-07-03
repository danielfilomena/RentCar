var usuarioController = new UsuarioController();

var body = document.querySelector("body");
body.onload = usuarioController.CarregarUsuarios.bind(usuarioController);

var form = document.querySelector('#formulario');