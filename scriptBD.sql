CREATE TABLE if not exists Animadores(
  IdAnimador VARCHAR(9) UNIQUE,
  NombreAnimador VARCHAR(35),
  Especialidad VARCHAR(20) PRIMARY KEY,
  precio INT
  );

CREATE TABLE IF NOT EXISTS Clientes(
  IdCliente INT AUTO_INCREMENT PRIMARY KEY,
  NombreCliente VARCHAR(25),
  Direccion VARCHAR(35),
  Email VARCHAR(25),
  Contraseña VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS Fiesta(
  IdFiesta INT,
  fecha DATE,
  Especialidad VARCHAR(20),
  Duracion INT,
  TipoDeFiesta VARCHAR(20),
  Numero VARCHAR(9),
  EdadMedia INT,
  Importe INT,
  IdCliente INT,

   FOREIGN KEY (Especialidad) REFERENCES Animadores(Especialidad),
   FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente),
   PRIMARY KEY(Fecha, Especialidad)
);