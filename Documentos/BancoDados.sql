CREATE DATABASE "RentCar"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Portuguese_Brazil.1252'
    LC_CTYPE = 'Portuguese_Brazil.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
	
CREATE TABLE Usuario(
	usuarioId	serial not null,
	usuarioNome	varChar(10) not Null,
	usuarioSenha	varChar(10)	not Null,
		CONSTRAINT PK_Usuario_usuarioId PRIMARY KEY(usuarioID));
													
CREATE TABLE Veiculo(
	veiculoId	serial not null,
	veiculoModelo	varChar(20) not null,
	veiculoMarca	varChar(20) not null,
	veiculoAno	integer not null,
	veiculoPlaca	varChar(10) not null,
		CONSTRAINT PK_Veiculo_veiculoID PRIMARY KEY(veiculoID));

CREATE TABLE Cliente(
	clienteID	serial not null,
	clienteNome	varChar(100) not null,
	clienteCNH	varChar(20)	not null,
	clienteEndereco	varChar(200) not null,
		CONSTRAINT PK_Cliente_clienteID PRIMARY KEY(clienteID));
													
CREATE TABLE Reserva(
	reservaID	serial not null,
	veiculoID	int not null,
	clienteID	int not null,
	dataRetirada	date not null,
		CONSTRAINT PK_Reserva_reservaID PRIMARY KEY(reservaID),
			CONSTRAINT FK_Reserva_Veiculo_veiculoID FOREIGN KEY(veiculoID) REFERENCES Veiculo(veiculoID),
				CONSTRAINT FK_Reserva_Cliente_clienteID FOREIGN KEY(clienteID) REFERENCES Cliente(clienteID));
																								  
CREATE TABLE Locacao(
	locacaoID	serial not null,
	veiculoID	int not null,
	clienteID	int not null,
	dataRetirada	date not null,
	dataDevolucao	date not null,
	valor		decimal(19,2) null,
	formaPagamento	varChar(20) null,
		CONSTRAINT PK_Locacao_locacaoId	PRIMARY KEY(locacaoID),
			CONSTRAINT FK_Locacao_Veiculo_veiculoID FOREIGN KEY(veiculoID) REFERENCES Veiculo(veiculoID),
				CONSTRAINT FK_Locacao_Cliente_clienteID FOREIGN KEY(clienteID) REFERENCES Cliente(clienteID));

CREATE TABLE Devolucao(
	devolucaoID	serial not null,
	veiculoID	int not null,
	clienteID	int not null,
	dataDevolucao	date not null,
	tanque	int	not null CONSTRAINT DF_Devolucao_tanque DEFAULT(0),
	avaria  int	not null CONSTRAINT DF_Devolucao_avaria DEFAULT(0),
	valorTotal decimal(19,2) not null,
		CONSTRAINT PK_Devolucao_devolucaoID	PRIMARY KEY(devolucaoID),
			CONSTRAINT FK_Devolucao_Veiculo_veiculoID FOREIGN KEY(veiculoID) REFERENCES Veiculo(veiculoID),
				CONSTRAINT FK_Devolucao_Cliente_clienteID FOREIGN KEY(clienteID) REFERENCES Cliente(clienteID));
		
																								  
																								  
																								  
																								  
																								  