class LocacaoController{

    locacaoService = new LocacaoHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var locacao = new Locacao();
        locacao.id = document.querySelector("#codigo").value;
        locacao.veiculoId = document.querySelector("#selectVeiculo").value;
        locacao.clienteId = document.querySelector("#selectCliente").value;
        locacao.dataRetirada = document.querySelector("#dataRetirada").value;
        locacao.dataDevolucao = document.querySelector("#dataDevolucao").value;
        locacao.valor = document.querySelector("#valor").value;
        locacao.formaPagamento = document.querySelector("#formaPagamento").value;
        
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

    CarregarLocacoes(){
        
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

    }

}