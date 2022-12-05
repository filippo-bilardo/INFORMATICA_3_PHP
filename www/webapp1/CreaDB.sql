CREATE TABLE `webapp1`.`nuova` ( 
    `CF` VARCHAR(16) NOT NULL , 
    `fk_user` VARCHAR(20) NOT NULL , 
    PRIMARY KEY (`CF`(16)), 
    INDEX `fk_user_idx` (`fk_user`(20))
) ENGINE = InnoDB;