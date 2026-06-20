

CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('donor', 'admin') NOT NULL
);

CREATE TABLE Donation (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(10, 2) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

CREATE TABLE Disaster (
    disaster_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    description TEXT
);

CREATE TABLE Distribution (
    distribution_id INT AUTO_INCREMENT PRIMARY KEY,
    donation_id INT,
    disaster_id INT,
    distributed_amount DECIMAL(10, 2) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donation_id) REFERENCES Donation(donation_id) ON DELETE CASCADE,
    FOREIGN KEY (disaster_id) REFERENCES Disaster(disaster_id) ON DELETE CASCADE
);

