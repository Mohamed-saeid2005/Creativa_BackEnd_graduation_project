-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS restaurant_native CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE restaurant_native;

-- 1. جدول المستخدمين (Users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. جدول الطلبات (Orders)
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    table_number INT NOT NULL,
    items TEXT NOT NULL,
    total_price DECIMAL(8, 2) NOT NULL,
    status ENUM('pending', 'cooking', 'served', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- مستخدم تجريبي (كلمة المرور: password123)
INSERT INTO users (name, email, password) VALUES 
('Admin User', 'admin@restaurant.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- طلبات تجريبية
INSERT INTO orders (customer_name, table_number, items, total_price, status) VALUES 
('أحمد محمود', 3, '2x شاورما دجاج، 1x بيبسي', 140.00, 'pending'),
('سارة علي', 5, '1x بيتزا مارجريتا، 1x سلطة خضراء', 185.50, 'cooking'),
('محمد كمال', 1, '1x برجر لحم دبل، 1x بطاطس', 160.00, 'served');
