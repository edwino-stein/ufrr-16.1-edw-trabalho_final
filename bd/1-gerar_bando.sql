-- Criar banco
CREATE DATABASE `web_final1`;

-- Criar usuário para acesso
CREATE USER 'web_final1'@'%' IDENTIFIED WITH mysql_native_password AS '123456';

-- Define parmições de acesso
GRANT USAGE ON *.* TO 'web_final1'@'%'
    REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0
    MAX_CONNECTIONS_PER_HOUR 0
    MAX_UPDATES_PER_HOUR 0
    MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `web_final1`.* TO 'web_final1'@'%';
