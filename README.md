# 🛒 E-Commerce Laravel API

![Laravel](https://img.shields.io/badge/Laravel-API-red)
![PHP](https://img.shields.io/badge/PHP-8.x-blue)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📌 Overview
A RESTful API built with **Laravel** for an e-commerce system.  
Supports multiple roles:

- 👤 Users  
- 🛍️ Traders  
- 🚚 Delivery  
- 🛠️ Admin  

Handles products, orders, categories, notifications, and authentication.

---

## ⚙️ Features
- 🔐 Authentication (Register / Login / Verify)
- 📦 Product Management
- 🧾 Order System
- 🛍️ Trader System
- 🚚 Delivery Management
- 🔔 Notifications
- 🛠️ Admin Approval

---

## 🛠️ Installation

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
composer install
cp .env.example .env
php artisan key:generate

⚙️ Configure Database
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate
php artisan serve

🔐 Authentication

Using Laravel Sanctum

Authorization: Bearer {token}

📡 API Endpoints

👤 User:
| Method | Endpoint           | Description     |
| ------ | ------------------ | --------------- |
| GET    | /api/              | Get all users   |
| GET    | /api/getUsers/{id} | Admin users     |
| POST   | /api/register      | Register        |
| POST   | /api/login         | Login           |
| POST   | /api/verify/{id}   | Verify          |
| PUT    | /api/forget/{id}   | Forget password |
| PUT    | /api/reset/{id}    | Reset password  |

📦 Product
| Method | Endpoint            | Description    |
| ------ | ------------------- | -------------- |
| GET    | /api/product        | All products   |
| GET    | /api/product/{id}   | Single product |
| POST   | /api/product/create | Create product |

🧾 Order
| Method | Endpoint               | Description  |
| ------ | ---------------------- | ------------ |
| GET    | /api/order             | All orders   |
| GET    | /api/order/{id}        | Single order |
| POST   | /api/order/create/{id} | Create order |

🗂️ Category
| Method | Endpoint             | Description     |
| ------ | -------------------- | --------------- |
| GET    | /api/category        | All categories  |
| GET    | /api/category/{id}   | Single category |
| POST   | /api/category/create | Create category |

🛍️ Trader
| Method | Endpoint                 | Description       |
| ------ | ------------------------ | ----------------- |
| GET    | /api/trader              | All traders       |
| POST   | /api/trader/add          | Add trader        |
| POST   | /api/trader/upload       | Upload product    |
| GET    | /api/deliver/trader/{id} | Trader deliveries |

🚚 Delivery
| Method | Endpoint            | Description     |
| ------ | ------------------- | --------------- |
| GET    | /api/deliver        | All deliveries  |
| POST   | /api/deliver/create | Create delivery |

🔔 Notifications
| Method | Endpoint    | Description       |
| ------ | ----------- | ----------------- |
| GET    | /api/notify | All notifications |

🛠️ Admin
| Method | Endpoint                 | Description    |
| ------ | ------------------------ | -------------- |
| PATCH  | /api/trader/confirm/{id} | Confirm trader |

🧪 Testing
Postman