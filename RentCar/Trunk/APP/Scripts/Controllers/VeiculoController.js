class VeiculoController{

    veiculoService = new VeiculoHttpService();

    constructor(){

    }

    salvar(event){

        console.log("salvar");

        var self = this;
        event.preventDefault();
        var veiculo = new Veiculo();
        
        veiculo.id = document.querySelector("#codigo").value;
        veiculo.marca = document.querySelector("#marca").value;
        veiculo.modelo = document.querySelector("#modelo").value;
        veiculo.ano = document.querySelector("#ano").value;
        veiculo.placa = document.querySelector("#placa").value;
        
        this.veiculoervice.enviarVeiculo(veiculo,
            (resposta, erro) => {
                if(resposta){
                    
                    self.CarregarVeiculos();
                    self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    limparFormulario(){
        
        document.querySelector("#codigo").value="";
        document.querySelector("#marca").value="";
        document.querySelector("#modelo").value="";
        document.querySelector("#ano").value="";
        document.querySelector("#placa").value="";
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