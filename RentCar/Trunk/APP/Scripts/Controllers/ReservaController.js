class ReservaController{

    reservaService = new ReservaHttpService();

    constructor(){

    }

    salvar(event){

        var self = this;
        event.preventDefault();
        var reserva = new Reserva();
        reserva.id = document.querySelector("#codigo").value;
        reserva.idVeiculo = document.querySelector("#selectVeiculo").value;
        reserva.idCliente = document.querySelector("#selectCliente").value;
        reserva.dataretirada = document.querySelector("#data").value;
        
        this.reservaService.enviarReserva(reserva,
            (resposta, erro) => {
                if(resposta){
                    self.CarregarReserva();            
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
               var reservas = JSON.parse(this.responseText);
               carregarTabela(reservas);               
            }

        };

        xhttp.open("GET", "http://localhost:8080/reservas");
        xhttp.send();        

        CarregarCliente();

    }

}