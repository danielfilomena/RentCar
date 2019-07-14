class DevolucaoController{

    devolucaoService = new DevolucaoHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var devolucao = new Devolucao();
        devolucao.id = document.querySelector("#codigo").value;
        devolucao.idVeiculo = document.querySelector("#selectVeiculo").value;
        devolucao.idCliente = document.querySelector("#selectCliente").value;
        devolucao.datadevolucao = document.querySelector("#data").value;
        devolucao.tanque = document.querySelector("#tanque").value;
        devolucao.avaria = document.querySelector("#avaria").value;
        devolucao.valortotal = document.querySelector("#dvalortotal").value;
        
        this.devolucaoService.enviarDevolucao(devolucao,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarDevolucao();            
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    Carregardevolucoes(){
        
        var self = this;
        console.log("carregando devolucoes...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               var devolucoes = JSON.parse(this.responseText);
               carregarTabela(devolucoes);               
            }

        };

        xhttp.open("GET", "http://localhost:8080/devolucoes");
        xhttp.send();        

        CarregarDevolucao();

    }

}