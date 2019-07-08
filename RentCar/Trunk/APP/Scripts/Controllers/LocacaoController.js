class LocacaoController{

    locacaoService = new LocacaoHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var locacao = new Locacao();
        locacao.veiculo = document.querySelector("#veiculo").value;
        locacao.cliente = document.querySelector("#cliente").value;
        locacao.dataretirada = document.querySelector("#dataretirada").value;
        locacao.datadevolucao = document.querySelector("#datadevolucao").value;
        locacao.valor = document.querySelector("#valor").value;
        locacao.formapagamento = document.querySelector("#formapagamento").value;
        
        this.locacaoService.enviarLocacao(locacao,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarLocacao();
                    //self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    CarregarLocacao(){
        
        var self = this;
        console.log("carregando locacoes...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var locacoes = JSON.parse(this.responseText);
               carregarTabela(locacoes);
                              
            }

        };

        xhttp.open("GET", "http://localhost:8080/locacoes");
        xhttp.send();        

    }

}