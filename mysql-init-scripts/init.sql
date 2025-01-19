-- Maak database en gebruiker aan (als die niet bestaan)
CREATE DATABASE IF NOT EXISTS twitterclone;
CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'Admin123!';
GRANT ALL PRIVILEGES ON twitterclone.* TO 'admin'@'%';
FLUSH PRIVILEGES;
