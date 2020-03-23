/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 10.4.11-MariaDB : Database - saipos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`saipos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `saipos`;

/*Table structure for table `lista_todo` */

DROP TABLE IF EXISTS `lista_todo`;

CREATE TABLE `lista_todo` (
  `id_reg` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_responsavel` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `descricao` blob DEFAULT NULL,
  `situacao` enum('P','C') DEFAULT 'P' COMMENT 'P para Pendente, C para Concluída',
  `qtd_conc` int(1) DEFAULT 0,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `data_baixa` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin7;

/*Data for the table `lista_todo` */

insert  into `lista_todo`(`id_reg`,`nome_responsavel`,`email`,`descricao`,`situacao`,`qtd_conc`,`data_criacao`,`data_baixa`) values (5,'Felipe','felipe@teste.com','teste','C',2,'2020-03-20 17:24:28',NULL),(6,'Teste4','teste4@teste.com','lorem ipsum','C',2,'2020-03-20 17:49:06',NULL),(7,'Teste','teste@teste.com','teste2','P',2,'2020-03-20 17:58:01',NULL),(8,'Teste2','teste2@teste.com','teste3','C',1,'2020-03-20 17:58:50',NULL),(9,'Teste3','teste3@teste.com','teste4','P',0,'2020-03-20 19:21:58',NULL);

/*Table structure for table `sys_supervisor` */

DROP TABLE IF EXISTS `sys_supervisor`;

CREATE TABLE `sys_supervisor` (
  `id_reg` int(11) NOT NULL AUTO_INCREMENT,
  `nome_supervisor` varchar(20) DEFAULT NULL,
  `psw` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_supervisor` */

insert  into `sys_supervisor`(`id_reg`,`nome_supervisor`,`psw`) values (1,'Felipe','20f6a9308ce0977dd5d4f9b3a3f9a4bf');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
