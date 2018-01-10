

-- ---------------------------- --
-- AUTHOR: Daniel Kleebinder    --
-- CREATED ON: 01.04.2017       --
-- FOR DATABASE: webshop        --
-- ---------------------------- --


-- Create Database
Drop Database If Exists webshop;
Create Database webshop Default Character Set utf8;


-- Drop Tables
Drop Table If Exists webshop.user;
Drop Table If Exists webshop.product;


-- Create DB connection user
Drop User If Exists 'webshopuser'@'localhost';
Flush Privileges;

Create User 'webshopuser'@'localhost' Identified By 'CxW3b#77e8>.0ZZ^x0=-Qq*~uuz)1;(';
Grant All Privileges On webshop.* To 'webshopuser'@'localhost';
Flush Privileges;


-- Create "user" table
Create Table webshop.user (
    username    varchar(32) primary key,
    pwd         varchar(32),
    vorname     varchar(32),
    nachname    varchar(32),
    email       varchar(64),
    is_admin    boolean default false,
    is_ldap     boolean default false
);


-- Create "products" table
Create Table webshop.product (
    id          int auto_increment primary key,
    name        varchar(128),
    description text,
    rating      tinyint,
    imgpath     text,
    price       decimal(10, 2),
    Constraint check_rating Check (rating >= 0 And rating <= 5)
);