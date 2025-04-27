-- Create the Hospital Database
CREATE DATABASE IF NOT EXISTS HospitalManagement;

-- Use the Hospital Database
USE HospitalManagement;
show tables;
-- Create the Patients Table

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

select * from users;





CREATE TABLE IF NOT EXISTS Patients (
    PatientID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DateOfBirth DATE,
    Gender VARCHAR(10),
    Address VARCHAR(255),
    PhoneNumber VARCHAR(20),
    Email VARCHAR(100),
    EmergencyContactName VARCHAR(100),
    EmergencyContactPhone VARCHAR(20)
);

-- Create the Doctors Table
CREATE TABLE IF NOT EXISTS Doctors (
    DoctorID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Specialization VARCHAR(100),
    PhoneNumber VARCHAR(20),
    Email VARCHAR(100)
);

-- Create the Appointments Table
CREATE TABLE IF NOT EXISTS Appointments (
    AppointmentID INT PRIMARY KEY AUTO_INCREMENT,
    PatientID INT,
    DoctorID INT,
    AppointmentDate DATETIME,
    Reason VARCHAR(255),
    FOREIGN KEY (PatientID) REFERENCES Patients(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
);

-- Create the Departments Table
CREATE TABLE IF NOT EXISTS Departments (
    DepartmentID INT PRIMARY KEY AUTO_INCREMENT,
    DepartmentName VARCHAR(100)
);

-- Create the Doctor_Department Junction Table
CREATE TABLE IF NOT EXISTS Doctor_Department (
    DoctorID INT,
    DepartmentID INT,
    PRIMARY KEY (DoctorID, DepartmentID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

-- Create the MedicalRecords Table
CREATE TABLE IF NOT EXISTS MedicalRecords (
    RecordID INT PRIMARY KEY AUTO_INCREMENT,
    PatientID INT,
    DoctorID INT,
    AppointmentID INT,
    Diagnosis VARCHAR(255),
    Prescription VARCHAR(255),
    RecordDate DATETIME,
    FOREIGN KEY (PatientID) REFERENCES Patients(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID),
    FOREIGN KEY (AppointmentID) REFERENCES Appointments(AppointmentID)
);

-- Inserting sample data into Patients table.
INSERT INTO Patients (FirstName, LastName, DateOfBirth, Gender, Address, PhoneNumber, Email, EmergencyContactName, EmergencyContactPhone) VALUES
('Alice', 'Johnson', '1990-05-15', 'Female', '123 Main St, Anytown', '555-1234', 'alice.johnson@example.com', 'Bob Johnson', '555-5678'),
('Bob', 'Smith', '1985-11-20', 'Male', '456 Oak Ave, Anytown', '555-9876', 'bob.smith@example.com', 'Carol Smith', '555-4321'),
('Charlie', 'Brown', '2000-02-28', 'Male', '789 Pine Ln, Anytown', '555-1111', 'charlie.brown@example.com', 'David Brown', '555-2222');

-- Inserting sample data into Doctors table.
INSERT INTO Doctors (FirstName, LastName, Specialization, PhoneNumber, Email) VALUES
('Dr. Emily', 'Davis', 'Cardiology', '555-3333', 'emily.davis@example.com'),
('Dr. Frank', 'Miller', 'Orthopedics', '555-4444', 'frank.miller@example.com'),
('Dr. Grace', 'Wilson', 'Dermatology', '555-5555', 'grace.wilson@example.com');
select * from Doctors;

-- Inserting sample data into Appointments table.
INSERT INTO Appointments (PatientID, DoctorID, AppointmentDate, Reason) VALUES
(1, 1, '2024-03-10 10:00:00', 'Chest pain'),
(2, 2, '2024-03-11 14:00:00', 'Knee injury'),
(3, 3, '2024-03-12 16:00:00', 'Skin rash');

-- Inserting sample data into Departments table.
INSERT INTO Departments (DepartmentName) VALUES
('Cardiology'),
('Orthopedics'),
('Dermatology'),
('Neurology');

-- Inserting sample data into Doctor_Department junction table.
INSERT INTO Doctor_Department (DoctorID, DepartmentID) VALUES
(1, 1),
(2, 2),
(3, 3),
(1,4);

-- Inserting sample data into MedicalRecords table.
INSERT INTO MedicalRecords (PatientID, DoctorID, AppointmentID, Diagnosis, Prescription, RecordDate) VALUES
(1, 1, 1, 'Possible angina', 'Nitroglycerin', '2024-03-10 11:00:00'),
(2, 2, 2, 'Ligament tear', 'Pain relievers', '2024-03-11 15:00:00'),
(3, 3, 3, 'Eczema', 'Topical steroid', '2024-03-12 17:00:00');

-- Insert additional 15 sample patients
INSERT INTO Patients (FirstName, LastName, DateOfBirth, Gender, Address, PhoneNumber, Email, EmergencyContactName, EmergencyContactPhone) VALUES
('John', 'Doe', '1988-04-12', 'Male', '12 Cross St, City', '555-1010', 'john.doe@example.com', 'Emma Doe', '555-2020'),
('Sita', 'Rao', '1992-11-03', 'Female', '234 Maple St, City', '555-3030', 'sita.rao@example.com', 'Amit Rao', '555-4040'),
('Arjun', 'Mehta', '1979-07-19', 'Male', '56 Hill Rd, City', '555-5050', 'arjun.mehta@example.com', 'Neha Mehta', '555-6060'),
('Fatima', 'Shaikh', '1995-02-28', 'Female', '78 Lane 9, City', '555-7070', 'fatima.shaikh@example.com', 'Imran Shaikh', '555-8080'),
('Krishna', 'Iyer', '1983-08-14', 'Male', '90 East End, City', '555-9090', 'krishna.iyer@example.com', 'Radha Iyer', '555-0001'),
('Lata', 'Patil', '1991-06-21', 'Female', '102 Central Park, City', '555-1112', 'lata.patil@example.com', 'Jay Patil', '555-1313'),
('Ravi', 'Singh', '1986-10-10', 'Male', '1237 Ashoka Lane, City', '555-1414', 'ravi.singh@example.com', 'Kiran Singh', '555-1515'),
('Meera', 'Nair', '1993-01-30', 'Female', '303 Garden View, City', '555-1616', 'meera.nair@example.com', 'Anil Nair', '555-1717'),
('Nikhil', 'Verma', '1987-12-11', 'Male', '404 Riverside, City', '555-1818', 'nikhil.verma@example.com', 'Shweta Verma', '555-1919'),
('Ananya', 'Chopra', '1996-09-05', 'Female', '505 Blossom Lane, City', '555-2021', 'ananya.chopra@example.com', 'Rohit Chopra', '555-2122'),
('Vikram', 'Kapoor', '1982-03-22', 'Male', '606 Lotus Ave, City', '555-2323', 'vikram.kapoor@example.com', 'Preeti Kapoor', '555-2424'),
('Deepa', 'Mishra', '1990-07-07', 'Female', '707 Green Meadows, City', '555-2525', 'deepa.mishra@example.com', 'Raj Mishra', '555-2626'),
('Ajay', 'Bansal', '1978-11-18', 'Male', '808 Silver Road, City', '555-2727', 'ajay.bansal@example.com', 'Sneha Bansal', '555-2828'),
('Ritika', 'Sharma', '1984-02-25', 'Female', '909 Emerald Court, City', '555-2929', 'ritika.sharma@example.com', 'Vivek Sharma', '555-3031'),
('Karan', 'Desai', '1980-05-02', 'Male', '1001 Palm Grove, City', '555-3131', 'karan.desai@example.com', 'Juhi Desai', '555-3232');
select * from patients;

INSERT INTO Doctors (FirstName, LastName, Specialization, PhoneNumber, Email) VALUES
('Samantha', 'Adams', 'Pediatrics', '555-1001', 'samantha.adams@example.com'),
('James', 'Turner', 'Neurology', '555-1002', 'james.turner@example.com'),
('Olivia', 'Martinez', 'ENT', '555-1003', 'olivia.martinez@example.com'),
('Liam', 'White', 'General Surgery', '555-1004', 'liam.white@example.com'),
('Sophia', 'King', 'Gynecology', '555-1005', 'sophia.king@example.com'),
('William', 'Scott', 'Urology', '555-1006', 'william.scott@example.com'),
('Ava', 'Green', 'Psychiatry', '555-1007', 'ava.green@example.com'),
('Benjamin', 'Hill', 'Gastroenterology', '555-1008', 'benjamin.hill@example.com'),
('Mia', 'Baker', 'Pulmonology', '555-1009', 'mia.baker@example.com'),
('Elijah', 'Campbell', 'Oncology', '555-1010', 'elijah.campbell@example.com');

select * from Doctors;

INSERT INTO Appointments (PatientID, DoctorID, AppointmentDate, Reason) VALUES
(1, 1, '2025-04-20 09:00:00', 'Routine Checkup'),
(2, 2, '2025-04-20 10:30:00', 'Headache and Nausea'),
(3, 3, '2025-04-20 11:45:00', 'Skin Allergy'),
(4, 4, '2025-04-21 09:15:00', 'Back Pain'),
(5, 5, '2025-04-21 11:00:00', 'Annual Physical Exam'),
(6, 6, '2025-04-21 13:00:00', 'High Blood Pressure'),
(7, 7, '2025-04-22 10:00:00', 'Eye Irritation'),
(8, 8, '2025-04-22 14:30:00', 'Diabetes Consultation'),
(9, 9, '2025-04-23 09:45:00', 'Joint Pain'),
(10, 10, '2025-04-23 11:15:00', 'Follow-up Visit'),
(11, 1, '2025-04-24 10:30:00', 'Fatigue and Weakness'),
(12, 2, '2025-04-24 12:00:00', 'Cold and Flu'),
(13, 3, '2025-04-25 09:00:00', 'Stomach Ache'),
(14, 4, '2025-04-25 11:30:00', 'Migraine'),
(15, 5, '2025-04-25 13:15:00', 'Blood Test Review'),
(16, 6, '2025-04-26 10:45:00', 'Asthma Follow-up'),
(17, 7, '2025-04-26 12:30:00', 'Post Surgery Checkup'),
(18, 8, '2025-04-27 14:00:00', 'Nutrition Counseling');
select * from Appointments;
-- Example Queries:

-- Select all patients:
-- SELECT * FROM Patients;

-- Select doctors with specialization 'Cardiology':
-- SELECT * FROM Doctors WHERE Specialization = 'Cardiology';

-- Select appointments for a specific patient:
-- SELECT * FROM Appointments WHERE PatientID = 1;

-- Select Medical Records for a specific patient:
-- SELECT * FROM MedicalRecords WHERE PatientID = 1;

-- Select doctors and their respective departments:
-- SELECT Doctors.FirstName, Doctors.LastName, Departments.DepartmentName FROM Doctors JOIN Doctor_Department ON Doctors.DoctorID = Doctor_Department.DoctorID JOIN Departments ON Doctor_Department.DepartmentID = Departments.DepartmentID;