Base de datos:

create database multimedia;

use multimedia;

create table imagenes{
	id INT auto_increment primary key,
	nombre varchar(255),
	imagen longblob	
};

create table documentos{
	id INT auto_increment primary key,
	nombre varchar(255),
	pdf longblob	

};
