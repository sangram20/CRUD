-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    age INT
);

-- Insert sample data
INSERT INTO users (name, email, age) 
VALUES 
('John Doe', 'john@example.com', 25),
('Jane Smith', 'jane@example.com', 30),
('Bob Johnson', 'bob@example.com', 28);