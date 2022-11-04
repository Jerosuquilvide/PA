CREATE DATABASE TP;
USE TP;

CREATE TABLE USUARIO(
    ID INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NOMBRE VARCHAR(25) NOT NULL,
    EMAIL VARCHAR(45) NOT NULL,
    PASS VARCHAR(60) NOT NULL
)

CREATE TABLE NOTA(
    ID INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    U_ID INT(10) NOT NULL,
    CONTENIDO VARCHAR(255) NOT NULL,
    TITULO VARCHAR(25) NOT NULL,
    ESTADO BOOL NOT NULL,
    CONSTRAINT FK_USUARIO_NOTA FOREIGN KEY (U_ID) REFERENCES USUARIO(ID)
)

// CON ESO LO VAMOS A PODER ORDENAR POR PRIORIDAD