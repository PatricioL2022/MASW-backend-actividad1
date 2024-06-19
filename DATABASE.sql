create database actividad1grupo4;
use actividad1grupo4;

create table platform(
    id int auto_increment primary key,
    name varchar(100) not null unique
);
create table director(
    id int auto_increment primary key,
    name varchar(50) not null,
    lastname varchar(50) not null,
    birthday date not null,
    nationality varchar(50) not null
);
create table actor(
    id int auto_increment primary key,
    name varchar(50) not null,
    lastname varchar(50) not null,
    birthday date not null
);
create table language(
    id int auto_increment primary key,
    name varchar(50) not null unique,
    isocode varchar(10) not null unique
);
create table serie(
    id int auto_increment primary key,
    title varchar(250) not null,
    platformid int,
    directorid int,
    foreign key(platformid) references platform(id) on update cascade on delete restrict,
    foreign key(directorid) references director(id) on update cascade on delete set null
);
create table serieactor(
    id int auto_increment primary key,
    serieid int,
    actorid int,
    foreign key(serieid) references serie(id) on update cascade on delete cascade,
    foreign key(actorid) references actor(id) on update cascade on delete restrict
);
create table serieaudio(
    id int auto_increment primary key,
    serieid int,
    languageavailableaudio int,
    foreign key(serieid) references serie(id) on update cascade on delete cascade,
    foreign key(languageavailableaudio) references language(id) on update cascade on delete restrict
);
create table seriesubtitle(
    id int auto_increment primary key,
    serieid int,
    languageavailablesubtitle int,
    foreign key(serieid) references serie(id) on update cascade on delete cascade,
    foreign key(languageavailablesubtitle) references language(id) on update cascade on delete restrict
);

insert into platform(name) values
('Netfilx'),
('Amazon Prime Video'),
('Disney+'),
('Max');

insert into language(name,isocode) values
('English','en'),
('Japanese','ja'),
('Russian','ru'),
('Spanish (Mexico)','es-mx'),
('Chinese (Hong Kong)','zh-hk'),
('Hungarian','hu');

insert into actor(name,lastname,birthday) values
('Lisa','Ambalavanar','1992-07-17'),
('Ellie','Duckles','1991-03-1'),
('Benjamin','Nugent','1980-04-02'),
('Georgina','Sadler','1985-05-01'),
('Indianna','Ryan','1970-08-01'),
('Byron','Easman','1960-10-16'),
('Robert','De Niro','1943-08-17'),
('Jack','Nicholson','1937-04-22'),
('Marlon','Brando','1924-04-03'),
('Denzel','Washington','1954-12-28'),
('Meryl','Streep','1949-06-22'),
('Daniel','Day-Lewis','1957-04-29'),
('Tom','Hanks','1956-07-08');

insert into director(name,lastname,birthday,nationality) values
('Steven','Spielberg','1946-12-18','American'),
('Martin','Scorsese','1942-11-17','American'),
('Ridley','Scott','1937-11-30','British'),
('John','Woo','1946-11-22','Chinese'),
('James','Cameron','1954-08-16','Canadian'),
('Guillermo','Del Toro','1964-10-09','Mexican');

insert into serie(title,platformid,directorid) values
('Fallout',4,1),
('WandaVision',3,2),
('The Boys',2,3),
('The Witcher',1,4),
('The Falcon and the Winter Soldier',3,5),
('The Lord of the Rings',2,6);

insert into serieactor(serieid,actorid) values(1,1),(1,2),(1,3),(1,4);
insert into serieactor(serieid,actorid) values(2,5),(2,6),(2,7),(2,8);
insert into serieactor(serieid,actorid) values(3,9),(3,10),(3,11),(3,12),(3,13);
insert into serieactor(serieid,actorid) values(4,13),(4,12),(4,11),(4,10),(4,9),(4,8);
insert into serieactor(serieid,actorid) values(5,7),(5,6),(5,5),(5,4),(5,3),(5,2),(5,1);
insert into serieactor(serieid,actorid) values(6,1),(6,2),(6,3),(6,4);

insert into serieaudio(serieid,languageavailableaudio) values(1,1),(1,2);
insert into serieaudio(serieid,languageavailableaudio) values(2,2),(2,3),(2,4);
insert into serieaudio(serieid,languageavailableaudio) values(3,1),(3,5);
insert into serieaudio(serieid,languageavailableaudio) values(4,6);
insert into serieaudio(serieid,languageavailableaudio) values(5,6),(5,5),(5,4),(5,3);
insert into serieaudio(serieid,languageavailableaudio) values(6,2),(6,1);

insert into seriesubtitle(serieid,languageavailablesubtitle) values(1,3),(1,4);
insert into seriesubtitle(serieid,languageavailablesubtitle) values(2,5),(2,6);
insert into seriesubtitle(serieid,languageavailablesubtitle) values(3,2),(3,4),(3,3);
insert into seriesubtitle(serieid,languageavailablesubtitle) values(4,3),(4,2);
insert into seriesubtitle(serieid,languageavailablesubtitle) values(5,1),(5,2);
insert into seriesubtitle(serieid,languageavailablesubtitle) values(6,3),(6,4),(6,5),(6,6);