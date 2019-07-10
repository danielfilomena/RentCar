class UsuarioController{

    usuarioService = new UsuarioHttpService();

    constructor(){

    }

    salvar(event){

        console.log("salvar");

        var self = this;
        event.preventDefault();
        var usuario = new Usuario();
        usuario.nome = document.querySelector("#nome").value;
        usuario.login = document.querySelector("#login").value;
        usuario.senha = document.querySelector("#senha").value;
        
        this.usuarioService.enviarUsuario(usuario,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarUsuarios();
                    self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    limparFormulario(){
        document.querySelector("#nome").value="";
        document.querySelector("#login").value="";
        document.querySelector("#senha").value="";
    }

    CarregarUsuarios(){
        
        var self = this;
        console.log("carregando usuários...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var usuarios = JSON.parse(this.responseText);
               carregarTabela(usuarios);                              
            }

        };

        xhttp.open("GET", "http://localhost:8080/usuarios");
        xhttp.send();        
    }

    alterarUsuario(codigo){

        var self = this;
        console.log("buscando usuários...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var usuarios = JSON.parse(this.responseText);
             
               document.querySelector("#nome").value = usuario.nome;
               document.querySelector("#login").value = usuario.login;
               document.querySelector("#senha").value = usuario.senha;

            }

        };

        xhttp.open("GET", "http://localhost:8080/usuarios/" + codigo);
        xhttp.send();        

    }

}