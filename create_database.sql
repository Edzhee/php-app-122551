CREATE DATABASE menu;
CREATE USER 'takeaway_user'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON laptops.* TO 'takeaway_user'@'localhost';
FLUSH PRIVILEGES;
