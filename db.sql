create table admin
(
    id       int auto_increment
        primary key,
    Username varchar(30)  not null,
    Password varchar(255) not null
)
    charset = latin1;

create table bookcat
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    image varchar(100) not null
)
    charset = latin1;

create table books
(
    id           int(10) auto_increment
        primary key,
    title        varchar(100)                           not null,
    subno        int(10)                                not null,
    catno        int(10)                                not null,
    image        varchar(100)                           null,
    backimg      varchar(100)                           not null,
    contentimage varchar(100)                           not null,
    Author       varchar(70)                            not null,
    Publisher    varchar(30)                            not null,
    Medium       int(1)                                 not null,
    ISBN         varchar(30)                            not null,
    Pages        int(4)                                 not null,
    Binding      varchar(20)                            not null,
    Edition      varchar(8)                             null,
    MRP          float                                  not null,
    Discount     int(3)                                 not null,
    Timestamp    timestamp  default current_timestamp() not null on update current_timestamp(),
    charges      int                                    null,
    availability tinyint(1) default 1                   null
)
    charset = latin1;

create table booksub
(
    id    int(1) auto_increment
        primary key,
    name  varchar(50)  not null,
    catno int(10)      not null,
    image varchar(100) not null
)
    charset = latin1;

create table booksubsub
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    subno int(10)      not null,
    image varchar(100) not null
)
    charset = latin1;

create table orders
(
    OrderId   int auto_increment
        primary key,
    Name      varchar(30)                           not null,
    Items     varchar(50)                           not null,
    Total     int(5)                                not null,
    Address   varchar(100)                          not null,
    Email     varchar(50)                           not null,
    Contact   varchar(10)                           not null,
    Timestamp timestamp default current_timestamp() not null on update current_timestamp()
)
    charset = latin1;

create table subject
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    subno int(10)      null,
    image varchar(100) not null
)
    charset = latin1;


