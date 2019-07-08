class ReservaController{

    reservaService = new ReservaHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var reserva = new Reserva();
        reserva.veiculo = document.querySelector("#veiculo").value;
        reserva.cliente = document.querySelector("#cliente").value;
        reserva.dataretirada = document.querySelector("#dataretirada").value;
        
        this.reservaService.enviarReserva(reserva,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarReserva();
                    //self.limparFormulario();
                }
                else if(erro){
                    console.log("Erro: "+erro.msg);
                }
            });
    }

    CarregarReservas(){
        
        var self = this;
        console.log("carregando reservas...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
               //self.montarTabela(JSON.parse(this.responseText));
               var reservas = JSON.parse(this.responseText);
               carregarTabela(reservas);
                              
            }

        };

        xhttp.open("GET", "http://localhost:8080/reservas");
        xhttp.send();        

    }

}