CREATE TABLE `customer`(
   `id` INT(10) NOT NULL AUTO_INCREMENT,
   `customer_id` INT NOT NULL AUTO INCREMENT,
   `first_name` VARCHAR(40) NOT NULL,
   `last_name` VARCHAR (40) NOT NULL,
   `gender` VARCHAR(40) NULL,
   `adress` VARCHAR(40) NOT NULL,
   `zipcode` VARCHAR(40) NOT NULL,
   `date_of_birth` DATE NOT NULL,
   `email` VARCHAR(40) NOT NULL,
   `telephone_number` INT(40) NOT NULL,
   `city` VARCHAR(255) NOT NULL,
   `country` VARCHAR(255) NOT NULL,
   `image_url` VARCHAR(255) NULL,


   PRIMARY KEY(`id`)
)engine=InnoDB;

CREATE TABLE `products`(
   `id` INT(10) NOT NULL AUTO_INCREMENT,
   `product_id` INT(10) NOT NULL,
   `product_name` VARCHAR(40) NOT NULL,
   `product_price` INT(10) NOT NULL,
   `category` VARCHAR(40) NULL,
   `description` VARCHAR(255) NOT NULL,
    image_url VARCHAR (255) NULL,

   PRIMARY KEY (`id`),
)engine=InnoDB;


-- FOREIGN KEY (employee) REFERENCES employee(id)
