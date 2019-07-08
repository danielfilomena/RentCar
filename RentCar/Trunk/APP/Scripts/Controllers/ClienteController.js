class ClienteController{

    clienteService = new ClienteHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var cliente = new Cliente();
        cliente.nome = document.querySelector("#nome").value;
        cliente.cnh = document.querySelector("#cnh").value;
        cliente.endereco = document.querySelector("#endereco").value;
        
        this.clienteService.enviarCliente(cliente,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarClientes();
                    //self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    CarregarClientes(){
        
        var self = this;
        console.log("carregando clientes...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var clientes = JSON.parse(this.responseText);
               carregarTabela(clientes);
                              
            }

        };

        xhttp.open("GET", "http://localhost:8080/clientes");
        xhttp.send();        

    }

}