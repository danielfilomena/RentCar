class LocacaoController{

    locacaoService = new LocacaoHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var locacao = new Locacao();
        locacao.id = document.querySelector("#codigo").value;
        locacao.idVeiculo = document.querySelector("#selectVeiculo").value;
        locacao.idCliente = document.querySelector("#selectCliente").value;
        locacao.dataretirada = document.querySelector("#data").value;
        locacao.datadevolucao = document.querySelector("#data").value;
        locacao.valor = document.querySelector("#valor").value;
        locacao.formadepagamento = document.querySelector("#formadepagamento").value;
        
        this.locacaoService.enviarLocacao(locacao,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarLocacao();            
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    Carregarlocacoes(){
        
        var self = this;
        console.log("carregando locacoes...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               var locacoes = JSON.parse(this.responseText);
               carregarTabela(locacoes);               
            }

        };

        xhttp.open("GET", "http://localhost:8080/locacoes");
        xhttp.send();        

        CarregarLocacao();

    }

}