class VeiculoHttpService{

    constructor(){

    }

    enviarVeiculo(veiculo, callback){
                      
        var self = this;
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (this.readyState === 4 && this.status === 201) {
                console.log(JSON.parse(this.responseText));
                console.log("Status:201");
                callback(JSON.parse(this.responseText),null);    
            }
            else if(this.readyState === 4 && this.status !== 201){                
                callback(null,{msg:'Erro de statusCode'});    
            }
            
        };

        if(veiculo.id == ""){

            xhttp.open("POST", "http://localhost:8080/veiculos", true);
            xhttp.setRequestHeader("Content-Type","application/json");
            xhttp.send(JSON.stringify(veiculo));
        }
        else{

            xhttp.open("PUT", "http://localhost:8080/veiculos/" + veiculo.id, true);
            xhttp.setRequestHeader("Content-Type","application/json");
            xhttp.send(JSON.stringify(veiculo));

        }
        
    }

    limparFormulario(){

        document.querySelector("#codigo").value="";
        document.querySelector("#selectVeiculo").value="";
        document.querySelector("#selectCliente").value="";                        
        document.querySelector("#data").value="";

    }

    carregarVeiculos(callback) {

        var self = this;
        console.log("carregando veiculos ...");
        var xhttp = new XMLHttpRequest();
  
        xhttp.onreadystatechange = function () {
            
            if (this.readyState === 4 && this.status === 200) {
                callback(JSON.parse(this.responseText),null);    
            }
            else if(this.readyState === 4 && this.status !== 200){                
                callback(null,{msg:'Erro de statusCode'});    
            }
        };

        xhttp.open("GET", "http://localhost:8080/veiculos", true);
        xhttp.send();

        limparFormulario();
    }
}