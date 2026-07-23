create table livros (
    id int not null auto_increment,
    titulo varchar(50) not null,
    /* D=Drama, F=Ficção, R=Romance, O=Outro */
    genero varchar (1) not null,
    qtd_paginas int not null,
    autor varchar(70) not null default 'Desconecido',
    constraint pk_livros primary key (id)
);

alter table livros add column
autor varchar(70) not null default 'Desconecido';