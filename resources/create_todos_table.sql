CREATE TABLE todos (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    description varchar(255),
    isCompleted boolean DEFAULT false,
   	createdTime timestamp DEFAULT NOW(),
    personId int,
    PRIMARY KEY (id),
    FOREIGN KEY (personId) REFERENCES users(id)
);

