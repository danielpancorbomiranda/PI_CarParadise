-- CAR PARADISE, BASE DE DATOS
CREATE TABLE Tipo
(
    IdTipo		int (3) AUTO_INCREMENT,		    	            -- AUTO_INCREMENT
    NombreTipo 	VARCHAR (30) 		        NOT NULL,			-- 30 caracteres, no puede ser nulo
    CONSTRAINT PK_IdTipo PRIMARY KEY (IdTipo)
);

CREATE TABLE Empleado
(
    ApodoEmpleado 		VARCHAR (30),			                        -- 30 caracteres, clave primaria
    NombreEmpleado 		VARCHAR (30) 		        NOT NULL,		    -- 30 caracteres, no puede ser nulo
    Contrasena			VARCHAR (30)		        NOT NULL,
    IdTipo		int(3)			            NOT NULL,
    CONSTRAINT PK_ApodoEmpleado PRIMARY KEY (ApodoEmpleado),
    CONSTRAINT FK_IdTipo FOREIGN KEY (IdTipo) REFERENCES Tipo (IdTipo) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Categoria
(
    GrupoCategoria		VARCHAR (2), 			                    	-- 2 caracteres, clave primaria
    NombreCategoria 	VARCHAR (30)                NOT NULL, 			-- 30 caracteres, en mayusculas
    CONSTRAINT PK_GrupoCategoria PRIMARY KEY (GrupoCategoria)
);

CREATE TABLE Base
(
    CodigoBase			int(5), 				                        -- clave primaria
    NombreBase		 	VARCHAR (30)                   NOT NULL, 		-- 30 caracteres, en mayusculas
    Localidad		 	VARCHAR (30)                   NOT NULL, 		-- 30 caracteres, en mayusculas
    CONSTRAINT PK_CodigoBase PRIMARY KEY (CodigoBase)
);

CREATE TABLE Bono
(
    IdBono				int(3) AUTO_INCREMENT, 				            -- AUTO_INCREMENT, clave primaria
    Descuento		 	int (2), 
    Descripcion		 	VARCHAR (50)                    NOT NULL, 		-- 50 caracteres, en mayusculas			
    CONSTRAINT PK_IdBono PRIMARY KEY (IdBono)
);

CREATE TABLE Cliente
(
    Dni					VARCHAR (9),
    NombreCliente		VARCHAR (30)	                NOT NULL,
    Apellido1Cliente	VARCHAR (30)	                NOT NULL,
    Apellido2Cliente	VARCHAR (30)	                NOT NULL,
    Contrasena			VARCHAR (30)		                NOT NULL,
    Telefono			VARCHAR (12)	                NOT NULL,
    CONSTRAINT PK_Dni PRIMARY KEY (Dni)
);

CREATE TABLE Vehiculo
(
    Matricula 			VARCHAR (7), 		                		-- 7 caracteres, clave primaria
    Marca				VARCHAR (30)	                NOT NULL, 			-- 30 caracteres
    Modelo				VARCHAR (30)	                NOT NULL, 			-- 30 caracteres
    Km					int(5),	
    Combustible			VARCHAR (30),	
    Potencia			int (3),	
    Imagen 				LONGBLOB,
    FechaExpiracion		DATE,
    Estado				VARCHAR (30)	                NOT NULL,
    Color				VARCHAR (7),   -- 7 -> hexadecimal
    CodigoBase			int(5)		                    NOT NULL, 
    GrupoCategoria		VARCHAR (2)                     NOT NULL, 
    CONSTRAINT PK_Matricula PRIMARY KEY (Matricula),
    CONSTRAINT FK_CodigoBase FOREIGN KEY (CodigoBase) REFERENCES Base (CodigoBase) ON DELETE CASCADE,
    CONSTRAINT FK_GrupoCategoria FOREIGN KEY (GrupoCategoria) REFERENCES Categoria (GrupoCategoria) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Alquiler -- Cliente_Alquila_Vehiculo
(
    Dni					VARCHAR (9),
    Matricula 			VARCHAR (7),
    FechaInicio			DATE,
    FechaFin			DATE,
    PrecioAlquiler		float (5,2)                     NOT NULL,
    IdBono 				int(3)		                    NOT NULL, 
    CONSTRAINT FK_Dni FOREIGN KEY (Dni) REFERENCES Cliente (Dni),
    CONSTRAINT FK_Matricula FOREIGN KEY (Matricula) REFERENCES Vehiculo (Matricula),
    CONSTRAINT FK_IdBono FOREIGN KEY (IdBono) REFERENCES Bono (IdBono) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PK_C_A_V PRIMARY KEY (Dni,Matricula,FechaInicio,FechaFin)
);

