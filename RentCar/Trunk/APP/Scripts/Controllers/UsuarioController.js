class UsuarioController{
    
    constructor(){

    }

    CarregarUsuarios(){
        
        var self = this;
        console.log("carregando usuários...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
                self.montarTabela(JSON.parse(this.responseText));
            }

        };

        xhttp.open("GET", "http://localhost:8080/usuarios");
        xhttp.send();
    }

    
    montarTabela(usuarios){
        var str=`
            <table class="table table-striped">
                <tr>
                    <th style='text-align: left;'>Código</th>
                    <th style='text-align: left;'>Nome</th>
                    <th style='text-align: left;'>Login</th>
                    <th><th>
                </tr>`;
    
        for(var i in usuarios){
            str+=`
                <tr>
                <td>${usuarios[i].id}</td>
                <td>${usuarios[i].nome}</td>
                <td>${usuarios[i].login}</td>
                <th> 
                    <a class="btn btn-xs btn-info" title="detalhes"><i class="glyphicon glyphicon-list"></i></a> 
                    <a class="btn btn-xs btn-warning" title="Alterar"><i class="glyphicon glyphicon-edit"></i></a>
                    <a class="btn btn-xs btn-danger" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>                     
                <th>
                </tr>
            `;
        } 
        str+= "</table>";
    
        var tabela = document.querySelector("main");
        tabela.innerHTML = str;
    }
    
}