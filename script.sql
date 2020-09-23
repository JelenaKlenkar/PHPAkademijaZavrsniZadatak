drop DATABASE if exists project_management;
CREATE DATABASE project_management CHARACTER SET utf8mb4 COLLATE
utf8mb4_unicode_ci;

use project_management;

create table job_position(
    id int not null primary key auto_increment,
    name_of_job_position varchar(255),
    job_position_description varchar(255)

);
create table employee(
    id int not null primary key auto_increment,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    personal_identification_number varchar(255),
    phone_number varchar(255),
    job_position int,
    foreign key (job_position) references job_position(id)

);

create table manager(
    id int not null primary key auto_increment,
    employee int,
    foreign key (employee)
    references  employee(id)

);

create table  team(
    id int not null primary key auto_increment,
    name_of_team varchar(255),
    job_position int,
    foreign key (job_position)
    references  job_position(id),
    manager int,
    foreign key (manager)
    references manager(id)

);

create table project(
    id int not null primary key auto_increment,
    name_of_project varchar(255),
    description_of_project varchar(255),
    starting_date date,
    ending_date date,
    completed tinyint,
    team int,
    foreign key (team)
    references team(id)

);
create table task(
    id int not null primary key auto_increment,
    description varchar (255),
    closed tinyint,
    employee int,
    foreign key(employee)
    references  employee(id),
    project int,
    foreign key(project)
    references project(id)
);