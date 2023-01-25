-- Create database - my_bank

CREATE DATABASE `my_bank` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `my_bank`;

-- my_bank.users

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(155) DEFAULT NULL,
  `profile_id` int(1) DEFAULT NULL,
  `hash_user_recover` VARCHAR(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_at`datetime DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` INT(11) DEFAULT NULL,
  UNIQUE(`email`),
  PRIMARY KEY (`id`) 
);

-- my_bank.profiles

CREATE TABLE `profiles` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`created_at` datetime NOT NULL,
  	`created_by` INT(11) NOT NULL,
  	`modified_at`datetime DEFAULT NULL,
  	`modified_by` INT(11) DEFAULT NULL,
  	`deleted_at` datetime DEFAULT NULL,
  	`deleted_by` INT(11) DEFAULT NULL,
  	PRIMARY KEY (`id`)
);

INSERT INTO users (nome, email, password, profile_id, created_at, created_by) VALUES ('Administrador do Sistema', 'admin@admin.com', '$2y$10$EX984acCtrUk/wC2tLJyN.msxeCWud2JCuF/hTnXhhDOzjAPVbY06', 1, NOW(), 1);
INSERT INTO users (nome, email, password, profile_id, created_at, created_by) VALUES ('Empresa de Teste', 'empresa@empresa.com', '$2y$10$EX984acCtrUk/wC2tLJyN.msxeCWud2JCuF/hTnXhhDOzjAPVbY06', 2, NOW(), 1);
INSERT INTO users (nome, email, password, profile_id, created_at, created_by) VALUES ('Consultor de Teste', 'consultor@consultor.com', '$2y$10$EX984acCtrUk/wC2tLJyN.msxeCWud2JCuF/hTnXhhDOzjAPVbY06', 3, NOW(), 1);

INSERT INTO profiles (name, created_at, created_by) VALUES ('Administrador', NOW(), 1);

INSERT INTO profiles (name, created_at, created_by) VALUES ('Empresa', NOW(), 1);

INSERT INTO profiles (name, created_at, created_by) VALUES ('Consultor', NOW(), 1);