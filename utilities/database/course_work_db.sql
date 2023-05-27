-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema course_work
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema course_work
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `course_work` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `course_work` ;

-- -----------------------------------------------------
-- Table `course_work`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `products_id` INT NOT NULL,
  `path` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_images_products1_idx` (`products_id` ASC) VISIBLE,
  CONSTRAINT `products_id`
    FOREIGN KEY (`products_id`)
    REFERENCES `course_work`.`products` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` CHAR(64) NOT NULL,
  `picture` VARCHAR(45) NULL DEFAULT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `addres` VARCHAR(45) NOT NULL,
  `date_ordered` DATETIME NOT NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_orders_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `course_work`.`users` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`orders_has_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`orders_has_products` (
  `orders_id` INT NOT NULL,
  `products_id` INT NOT NULL,
  `number_of_product_ordered` INT NOT NULL,
  PRIMARY KEY (`orders_id`, `products_id`),
  INDEX `fk_orders_has_products_products1_idx` (`products_id` ASC) VISIBLE,
  INDEX `fk_orders_has_products_orders1_idx` (`orders_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_has_products_orders1`
    FOREIGN KEY (`orders_id`)
    REFERENCES `course_work`.`orders` (`id`),
  CONSTRAINT `fk_orders_has_products_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `course_work`.`products` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `course_work`.`products_has_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_work`.`products_has_tags` (
  `products_id` INT NOT NULL,
  `tags_id` INT NOT NULL,
  PRIMARY KEY (`products_id`, `tags_id`),
  INDEX `fk_products_has_tags_tags1_idx` (`tags_id` ASC) VISIBLE,
  INDEX `fk_products_has_tags_products_idx` (`products_id` ASC) VISIBLE,
  CONSTRAINT `fk_products_has_tags_products`
    FOREIGN KEY (`products_id`)
    REFERENCES `course_work`.`products` (`id`),
  CONSTRAINT `fk_products_has_tags_tags1`
    FOREIGN KEY (`tags_id`)
    REFERENCES `course_work`.`tags` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
