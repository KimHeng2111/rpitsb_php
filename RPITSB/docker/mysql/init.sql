USE mydb;
CREATE TABLE tbl_category (
    catId INT PRIMARY KEY AUTO_INCREMENT, -- Use SERIAL in PostgreSQL or IDENTITY in SQL Server
    catName VARCHAR(100) NOT NULL,
    catNote TEXT,
    catOrder INT DEFAULT 0,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    imageUrl VARCHAR(255)
);