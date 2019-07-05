class ProdutoHttpService{
    constructor(){}
    enviarProduto(produto, callback){
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
        xhttp.open("POST", "http://localhost:8080/api/produtos", true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(produto));
    }

    carregarProdutos(callback) {
        var self = this;
        console.log("carregando produtos ...");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                callback(JSON.parse(this.responseText),null);    
            }
            else if(this.readyState === 4 && this.status !== 200){                
                callback(null,{msg:'Erro de statusCode'});    
            }
        };
        xhttp.open("GET", "http://localhost:8080/api/produtos", true);
        xhttp.send();
    }
}