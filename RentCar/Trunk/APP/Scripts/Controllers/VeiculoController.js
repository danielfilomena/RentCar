class VeiculoController{

    veiculoService = new VeiculoHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var veiculo = new Veiculo();
        veiculo.marca = document.querySelector("#marca").value;
        veiculo.modelo = document.querySelector("#modelo").value;
        veiculo.ano = document.querySelector("#ano").value;
        veiculo.placa = document.querySelector("#placa").value;
        
        this.veiculoService.enviarVeiculo(veiculo,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarVeiculos();
                    //self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    CarregarVeiculos(){
        
        var self = this;
        console.log("carregando veiculos...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var veiculos = JSON.parse(this.responseText);
               carregarTabela(veiculos);
                              
            }

        };

        xhttp.open("GET", "http://localhost:8080/veiculos");
        xhttp.send();        

    }

}