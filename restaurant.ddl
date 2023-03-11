DROP DATABASE IF EXISTS restaurantDB;
CREATE DATABASE restaurantDB;
USE restaurantDB;

CREATE TABLE Employee (
EmployeeID INT AUTO_INCREMENT NOT NULL,
EmployeeName VARCHAR(50),
EmployeeEmail VARCHAR(50),
EmployeeType CHAR(4) NOT NULL,
PRIMARY KEY(EmployeeID)
);

CREATE TABLE Chef_Credential (
ChefID INT NOT NULL,
CredentialName VARCHAR(50) NOT NULL,
PRIMARY KEY(ChefID, CredentialName),
FOREIGN KEY(ChefID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);

CREATE TABLE Schedule (
ScheduleID INT AUTO_INCREMENT NOT NULL,
EmployeeID INT NOT NULL,
ScheduleDay DATE,
StartTime TIME,
EndTime TIME,
PRIMARY KEY(ScheduleID),
FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);

CREATE TABLE Restaurant (
RestaurantName VARCHAR(40) NOT NULL,
Url VARCHAR(40),
RestaurantAddress VARCHAR(50),
PRIMARY KEY(RestaurantName)
);

CREATE TABLE Menu_Item (
MenuItemID INT AUTO_INCREMENT NOT NULL,
MenuItemName VARCHAR(30),
Price DECIMAL(5,2),
PRIMARY KEY(MenuItemID)
);

CREATE TABLE Restaurant_Order (
OrderID INT AUTO_INCREMENT NOT NULL,
EmployeeID INT NOT NULL,
OrderAmount DECIMAL(7,2),
Tip DECIMAL(5,2),
OrderTime DATETIME,
OrderDate DATE,
DeliveryTime DATETIME,
PRIMARY KEY(OrderID),
FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);


CREATE TABLE Order_Menu_Item (
OrderID INT NOT NULL,
MenuItemID INT NOT NULL,
Quantity INT NOT NULL,
PRIMARY KEY(OrderID, MenuItemID),
FOREIGN KEY(OrderID) REFERENCES Restaurant_Order(OrderID) ON DELETE CASCADE,
FOREIGN KEY(MenuItemID) REFERENCES Menu_Item(MenuItemID) ON DELETE CASCADE
);

CREATE TABLE Customer (
Email VARCHAR(50) NOT NULL,
FullName VARCHAR(50) NOT NULL,
PhoneNumber INTEGER,
DeliveryAddress VARCHAR(50) NOT NULL,
PRIMARY KEY(Email)
);

CREATE TABLE Payment (
PaymentID INT AUTO_INCREMENT NOT NULL,
PaymentDate DATE,
PaymentAmount DECIMAL(7,2),
Credit DECIMAL(8,2),
PRIMARY KEY(PaymentID)
);

CREATE TABLE Customer_Employee (
CustomerEmail VARCHAR(50) NOT NULL,
EmployeeID INT NOT NULL,
PRIMARY KEY(CustomerEmail, EmployeeID),
FOREIGN KEY(CustomerEmail) REFERENCES Customer(Email) ON DELETE CASCADE,
FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);

insert into Employee values
(1, 'Bob Smith', 'bob.smith@gmail.com', 'CHEF'),
(2, 'Amanda Smith', 'asmith90@hotmail.com', 'MGMT'),
(3, 'Rachel Jones', 'jones223@yahoo.ca', 'DLVR'),
(4, 'Grace Wallace', 'grace_wallace@gmail.com', 'SRVR'),
(5, 'Jacky Gold', 'jgold@gmail.com', 'CHEF'),
(6, 'Grace Adams', 'gadams53@rogers.com', 'SRVR'),
(7, 'Manny Jones', 'jones1111@yahoo.ca', 'DLVR')
;

insert into Chef_Credential values
(1, 'Certified Foodservice Professional'),
(1, 'Certified Chef de Cuisine'),
(1, 'Certified Personal Chef'),
(5, 'Certified Foodservice Professional'),
(5, 'Certified Chef de Cuisine'),
(5, 'Certified Personal Chef')
;

insert into Schedule values
(1, 1, '2023-01-01', '09:00:00', '12:00:00'),
(2, 1, '2023-01-02', '12:00:00', '14:00:00'),
(3, 2, '2023-01-02', '08:00:00', '15:00:00'),
(4, 3, '2023-01-03', '10:00:00', '12:00:00'),
(5, 4, '2023-01-04', '09:00:00', '19:00:00'),
(6, 5, '2023-01-06', '10:00:00', '20:00:00'),
(7, 5, '2023-01-07', '12:00:00', '13:00:00'),
(8, 6, '2023-01-07', '11:00:00', '17:00:00')
;

insert into Restaurant values
('Bobs Burgers', 'bobburger.com', '324 University Ave, Kingston, ON'),
('Pizza Monster', 'pizzamonster.com', '234 Princess Street, Kingston, ON'),
('Sima Sushi', 'simasushi.com', '111 Princess Street, Kingston, ON'),
('Crave', 'crave.com', '978 Princess Street, Kingston, ON'),
('Sushi Bar Dar', 'sushi.com', '223 Princess Street, Kingston, ON'),
('Pizza Studio', 'crave.com', '978 Princess Street, Kingston, ON')
;

insert into Menu_Item values
(1, 'Coffee', 2.30),
(2, 'Blondie', 3.00),
(3, 'Latte', 3.50),
(4, 'Cake', 5.00),
(5, 'Beyond Beef Burger', 12.90),
(6, 'Fries', 4.50),
(7, 'Fries', 5.50),
(8, 'Dynamite Roll', 13.50),
(9, 'California Roll', 5.00),
(10, 'Soda', 2.00),
(11, 'Soda', 3.00),
(12, 'Pizza', 18.00),
(13, 'Pizza', 23.00)
;

insert into Restaurant_Order values
(1, 7, 23.10, 10.12, '2023-01-02 12:59:59', '2023-01-02', '2023-01-02 13:59:59'),
(2, 3, 23.20, 10.11, '2023-01-01 12:59:59', '2023-01-01', '2023-01-01 13:59:59'),
(3, 7, 23.30, 9.20, '2023-01-01 12:59:59', '2023-01-01', '2023-01-01 13:59:59'),
(4, 3, 23.40, 10.12, '2023-01-05 12:59:59', '2023-01-05', '2023-01-05 13:59:59'),
(5, 7, 23.50, 2.30, '2023-01-01 12:59:59', '2023-01-01', '2023-01-01 13:59:59'),
(6, 3, 23.60, 12.20, '2023-01-10 12:59:59', '2023-01-10', '2023-01-10 13:59:59')
;

insert into Order_Menu_Item values
(1, 1, 5),
(1, 2, 3),
(2, 3, 2),
(2, 4, 1),
(3, 2, 4),
(4, 2, 4),
(5, 2, 4),
(6, 2, 4)
;

insert into Customer values
('shiyanboxer@gmail.com', 'Shiyan Boxer', 6722348698, '392 University Ave, Kingston, ON'),
('george@gmail.com', 'George Jones', 2348934233, '999 Princess Street, Kingston, ON'),
('a89@hotmail.com', 'Alex Smith', 999723489, '1 Albert Street, Kingston, ON'),
('sally23@gmail.com', 'Sally Boxer', 6422323698, '391 University Ave, Kingston, ON'),
('joeboxer@gmail.com', 'Joe Boxer', 642223698, '391 University Ave, Kingston, ON'),
('masonsmith@gmail.com', 'Mason Smith', 123456723, '393 University Ave, Kingston, ON')
;

insert into Payment values
(1, '2023-01-01', 23.89, 100.02),
(2, '2023-01-02', 13.49, 9.02),
(3, '2023-01-02', 22.56, 34.24),
(4, '2023-01-05', 100.34, 5.34),
(5, '2023-01-06', 44.33, 99.43),
(6, '2023-01-09', 29.77, 77.84)
;

insert into Customer_Employee values
('shiyanboxer@gmail.com', 1),
('shiyanboxer@gmail.com', 2),
('shiyanboxer@gmail.com', 3),
('george@gmail.com', 1),
('george@gmail.com', 3),
('george@gmail.com', 5),
('george@gmail.com', 6)
;
