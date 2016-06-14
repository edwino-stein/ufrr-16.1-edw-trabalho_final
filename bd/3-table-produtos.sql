CREATE TABLE `web_final1`.`produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `descricao` TEXT NULL,
    `valor` FLOAT NOT NULL,
    `categoria` INT NOT NULL,
    `removido` BOOLEAN NOT NULL,
    `thumbnail` LONGBLOB NULL,
    `thumbnail_mime` VARCHAR(20) NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `web_final1`.`produtos` ADD INDEX(`categoria`);
ALTER TABLE `web_final1`.`produtos` ADD CONSTRAINT `categoria_produto`
    FOREIGN KEY (`categoria`) REFERENCES `categorias`(`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
