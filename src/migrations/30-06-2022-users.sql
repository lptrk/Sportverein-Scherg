CREATE TABLE `user` (
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `name` VARCHAR(30) NOT NULL DEFAULT '0',
                        `password` VARCHAR(30) NOT NULL DEFAULT '0',
                        PRIMARY KEY (`id`)
)
    COLLATE='utf8mb4_general_ci'
;