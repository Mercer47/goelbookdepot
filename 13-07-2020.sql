create table admin
(
    id       int auto_increment
        primary key,
    Username varchar(30)  not null,
    Password varchar(255) not null
)
    engine = InnoDB;

create table bookcat
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    image varchar(100) not null
)
    engine = InnoDB;

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
    charges      int        default 0                   null,
    availability tinyint(1) default 1                   null,
    Timestamp    timestamp  default current_timestamp() not null on update current_timestamp()
)
    engine = InnoDB;

create table booksub
(
    id    int(1) auto_increment
        primary key,
    name  varchar(50)  not null,
    catno int(10)      not null,
    image varchar(100) not null
)
    engine = InnoDB;

create table booksubsub
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    subno int(10)      not null,
    image varchar(100) not null
)
    engine = InnoDB;

create table intent
(
    id     varchar(255) not null,
    object varchar(255) not null,
    amount varchar(255) not null
);

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
    intent_id varchar(255)                          null,
    Status    varchar(50)                           not null,
    Timestamp timestamp default current_timestamp() not null on update current_timestamp()
)
    engine = InnoDB;

create table roles
(
    id   int auto_increment
        primary key,
    name varchar(255) null
);

create table subject
(
    id    int(10) auto_increment
        primary key,
    name  varchar(50)  not null,
    subno int(10)      null,
    image varchar(100) not null
)
    engine = InnoDB;

create table users
(
    id       int auto_increment
        primary key,
    name     varchar(255) null,
    address  text         null,
    email    varchar(255) null,
    password text         null,
    role_id  int          null
);

create index users_roles__fk
    on users (role_id);


