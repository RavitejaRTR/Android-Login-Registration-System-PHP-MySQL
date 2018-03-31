CREATE DATABASE application;

USE application;

create table users(	id INT NOT NULL AUTO_INCREMENT, 
					username VARCHAR(20) NOT NULL UNIQUE, 	/* Solves unique id problem*/
					email VARCHAR(50) NOT NULL,
					encrypted_password VARCHAR(256) NOT NULL, 
					created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					primary key(id)
					);
					
INSERT INTO users (username, email, encrypted_password) VALUES ('teja1004','anyemail@gmail.com','password_encrypted');

create table story(	id INT NOT NULL AUTO_INCREMENT, 
					title VARCHAR(200) NOT NULL UNIQUE, 	/* Solves unique id problem*/
					created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					storyline VARCHAR(5000),
					created_by INT,
					primary key(id),
					FOREIGN key(created_by) REFERENCES users(id)	/* Assigns the creator of story */
					);
					
INSERT INTO story (title,storyline,created_by) VALUES ('Age of Earth','About a billion years ago when the big bang exploded earth came into existance.',1);
