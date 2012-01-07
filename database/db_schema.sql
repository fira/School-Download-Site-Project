-- Oracle 10g


CREATE TABLE downloads 
    ( 
     id_download NUMBER NOT NULL ,
     id_user NUMBER NOT NULL , 
     id_file NUMBER NOT NULL , 
     download_date NUMBER 
    ) 
;




CREATE TABLE files 
    ( 
     name VARCHAR2 (50)  NOT NULL , 
     type VARCHAR2 (20)  NOT NULL , 
     filesize NUMBER  NOT NULL , 
     id_user NUMBER NOT NULL ,
     id_file NUMBER  NOT NULL , 
     upload_date NUMBER NOT NULL , 
     downloads NUMBER NOT NULL , 
     description VARCHAR2 (100) 
    ) 
;



ALTER TABLE files 
    ADD CONSTRAINT files_PK PRIMARY KEY ( id_file ) ;




CREATE TABLE users 
    ( 
     id_user NUMBER  NOT NULL , 
     username VARCHAR2 (20)  NOT NULL , 
     password VARCHAR2 (62)  NOT NULL , 
     lastname VARCHAR2 (50)  NOT NULL , 
     firstname VARCHAR2 (50)  NOT NULL , 
     mail VARCHAR2 (30)  NOT NULL 
    ) 
;



ALTER TABLE users 
    ADD CONSTRAINT users_PK PRIMARY KEY ( id_user ) ;
    
ALTER TABLE downloads 
    ADD CONSTRAINT downloads_PK PRIMARY KEY ( id_download ) ;



ALTER TABLE files 
    ADD CONSTRAINT Relation_4 FOREIGN KEY 
    ( 
     id_user
    ) 
    REFERENCES users 
    ( 
     id_user
    ) 
    ON DELETE SET NULL 
;


ALTER TABLE downloads 
    ADD CONSTRAINT Relation_6 FOREIGN KEY 
    ( 
     id_user
    ) 
    REFERENCES users 
    ( 
     id_user
    ) 
    ON DELETE SET NULL 
;


ALTER TABLE downloads 
    ADD CONSTRAINT Relation_7 FOREIGN KEY 
    ( 
     id_file
    ) 
    REFERENCES files 
    ( 
     id_file
    ) 
    ON DELETE SET NULL 
;
