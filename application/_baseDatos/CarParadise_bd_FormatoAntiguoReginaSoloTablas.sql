-- CAR PARADISE, BASE DE DATOS
CREATE TABLE Tipo
(
    IdTipo 		        NUMBER (3),		    	-- AUTO_INCREMENT
    NombreTipo 	        VARCHAR2 (30) 		CONSTRAINT NONULO_NombreTipo NOT NULL,			-- 30 caracteres, no puede ser nulo
    CONSTRAINT PK_IdTipo PRIMARY KEY (IdTipo)
);

CREATE TABLE Empleado
(
    ApodoEmpleado 		VARCHAR2 (30),			-- 30 caracteres, clave primaria
    NombreEmpleado 		VARCHAR2 (30) 		CONSTRAINT NONULO_NombreEmpleado NOT NULL,		-- 30 caracteres, no puede ser nulo
    Contrasena			VARCHAR2 (30)		CONSTRAINT NONULO_ContrasenaE NOT NULL,
    IdTipo       		NUMBER(3)			CONSTRAINT NONULO_IdTipo NOT NULL,
    CONSTRAINT PK_ApodoEmpleado PRIMARY KEY (ApodoEmpleado),
    CONSTRAINT FK_IdTipo FOREIGN KEY (IdTipo) REFERENCES Tipo (IdTipo) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Categoria
(
    GrupoCategoria		VARCHAR2 (2), 				--  2 caracteres, clave primaria
    NombreCategoria 	VARCHAR2 (30)    CONSTRAINT NONULO_NombreCategoria NOT NULL, 			-- 30 caracteres, 
    CONSTRAINT PK_GrupoCategoria PRIMARY KEY (GrupoCategoria)
);

CREATE TABLE Base
(
    CodigoBase			NUMBER(5), 				-- clave primaria
    NombreBase		 	VARCHAR2 (30)    CONSTRAINT NONULO_NombreBase NOT NULL, 	    -- 30 caracteres, 
    Localidad		 	VARCHAR2 (30)    CONSTRAINT NONULO_Localidad NOT NULL, 			-- 30 caracteres, 
    CONSTRAINT PK_CodigoBase PRIMARY KEY (CodigoBase)
);

CREATE TABLE Bono
(
    IdBono				NUMBER(3), 				-- AUTO_INCREMENT, clave primaria
    Descuento		 	NUMBER (2), 			
    Descripcion		 	VARCHAR2 (50)    CONSTRAINT NONULO_Descripcion NOT NULL, 			-- 50 caracteres, en mayusculas
    CONSTRAINT PK_IdBono PRIMARY KEY (IdBono)
);

CREATE TABLE Cliente
(
    Dni					VARCHAR (9),
    NombreCliente		VARCHAR2 (30)	CONSTRAINT NONULO_NombreCliente NOT NULL,
    Apellido1Cliente	VARCHAR2 (30)	CONSTRAINT NONULO_Apellido1Cliente NOT NULL,
    Apellido2Cliente	VARCHAR2 (30)	CONSTRAINT NONULO_Apellido2Cliente NOT NULL,
    Contrasena			VARCHAR2 (30)		CONSTRAINT NONULO_ContrasenaC NOT NULL,
    Telefono			VARCHAR2 (12)	CONSTRAINT NONULO_TelefonoCliente NOT NULL,
    CONSTRAINT PK_Dni PRIMARY KEY (Dni)
);

CREATE TABLE Vehiculo
(
    Matricula 			VARCHAR (7), 				-- 7 caracteres, clave primaria
    Marca				VARCHAR2 (30)	CONSTRAINT NONULO_Marca NOT NULL, 			-- 30 caracteres
    Modelo				VARCHAR2 (30)	CONSTRAINT NONULO_Modelo NOT NULL, 			-- 30 caracteres
    Km					NUMBER(5),	
    Combustible			VARCHAR2 (30),	
    Potencia			NUMBER (3),	
    Imagen 				LONGBLOB,
    FechaExpiracion		DATE,
    Estado				VARCHAR2 (30)	CONSTRAINT NONULO_Estado NOT NULL,
    Color				VARCHAR2 (7),   -- 7 -> hexadecimal
    CodigoBase			NUMBER(5)		CONSTRAINT NONULO_FK_CodigoBase NOT NULL, 
    GrupoCategoria		VARCHAR2 (2)	    CONSTRAINT NONULO_FK_GrupoCategoria NOT NULL, 
    CONSTRAINT PK_Matricula PRIMARY KEY (Matricula),
    CONSTRAINT FK_CodigoBase FOREIGN KEY (CodigoBase) REFERENCES Base (CodigoBase) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_GrupoCategoria FOREIGN KEY (GrupoCategoria) REFERENCES Categoria (GrupoCategoria) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Alquiler -- Cliente_Alquila_Vehiculo
(
    Dni					VARCHAR (9),
    Matricula 			VARCHAR (7),
    FechaInicio			DATE,
    FechaFin			DATE,
    PrecioAlquiler		NUMBER(5,2)     CONSTRAINT NONULO_PrecioAlquiler NOT NULL,
    IdBono 				NUMBER(3)		CONSTRAINT NONULO_FK_IdBono NOT NULL, 
    CONSTRAINT FK_Dni FOREIGN KEY (Dni) REFERENCES Cliente (Dni),
    CONSTRAINT FK_Matricula FOREIGN KEY (Matricula) REFERENCES Vehiculo (Matricula),
    CONSTRAINT FK_IdBono FOREIGN KEY (IdBono) REFERENCES Bono (IdBono) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PK_C_A_V PRIMARY KEY (Dni,Matricula,FechaInicio,FechaFin)
);