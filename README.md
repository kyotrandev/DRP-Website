# Daily Recipes Provider (DRP) - Web Application

## 🌟 Project Overview

Daily Recipes Provider (DRP) is a comprehensive web application designed to deliver personalized nutritious recipes to users based on their individual health profiles. The application analyzes user information including age, health conditions, dietary preferences, and nutritional requirements to provide tailored recipe recommendations that promote balanced nutrition and healthy living.

## 🏗️ Architecture & Design Patterns

### MVC Architecture
The application follows the **Model-View-Controller (MVC)** design pattern for clean separation of concerns:
- **Models**: Handle data logic and database interactions
- **Views**: Manage user interface and presentation layer
- **Controllers**: Process user input and coordinate between Models and Views

### Project Structure
```
DRP-Website/
├── Web/
│   ├── App/
│   │   ├── Controllers/     # Application controllers
│   │   ├── Models/          # Data models and business logic
│   │   ├── Views/           # User interface templates
│   │   └── Core/            # Core framework components
│   ├── Public/              # Static assets (CSS, JS, images)
│   └── Config/              # Configuration files
├── Data/                    # Database initialization scripts
└── zdocker/                 # Docker configuration
```

## 🚀 Technology Stack

### Backend Technologies
- **PHP 8.2**: Core server-side programming language
- **MySQL 8.3**: Relational database management system
- **Redis 7.2**: In-memory caching for improved performance
- **PDO**: Database abstraction layer for secure database operations

### Frontend Technologies
- **HTML5 & CSS3**: Modern web standards for structure and styling
- **JavaScript (ES6+)**: Client-side interactivity and AJAX functionality
- **jQuery**: DOM manipulation and event handling

### Development & Deployment
- **Docker & Docker Compose**: Containerization for consistent development environment
- **Composer**: PHP dependency management with PSR-4 autoloading
- **Apache HTTP Server**: Web server with mod_rewrite enabled

## ✨ Key Features

### Core Functionality
- **User Management**: Complete user registration, authentication, and profile management
- **Recipe Management**: CRUD operations for recipes with image upload capabilities
- **Ingredient Database**: Comprehensive ingredient management with nutritional information
- **Nutrition Calculator**: Advanced BMI calculator and nutritional analysis tools
- **Search Functionality**: Powerful search capabilities for finding recipes by name and filtering by categories

### Administrative Features
- **Admin Dashboard**: Complete administrative interface for system management
- **Content Moderation**: Create, update, delete, and moderate user-generated content
- **User Administration**: Activate/deactivate user accounts and manage permissions
- **Data Analytics**: View and manage system-wide statistics

### Technical Features
- **Security**: Input validation, SQL injection prevention, and secure file uploads
- **Performance**: Redis caching implementation for optimized database queries
- **Responsive Design**: Mobile-friendly user interface
- **Pagination**: Efficient data browsing with paginated results
- **Error Handling**: Comprehensive error logging and user-friendly error pages
- **Search System**: Intuitive search interface with real-time filtering and category-based browsing

## 🛠️ Installation & Setup

### Prerequisites
- Docker Desktop installed on your system

### Option 1: Using Docker Image (Recommended)
1. **Pull the Docker image**
   ```bash
   docker pull kyotran/drp-web-app:latest
   ```

2. **Run the application**
   ```bash
   docker compose -f docker-compose.yml up -d
   ```

3. **Access the application**
   - Main application: `http://localhost:8000`
   - phpMyAdmin: `http://localhost:8080`
   - Database: `localhost:3306`
   - Redis: `localhost:6379`

### Option 2: Building from Source
1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd DRP-Website
   ```

2. **Start the application**
   ```bash
   docker compose up -d
   ```

3. **Access the application**
   - Main application: `http://localhost:8000`
   - phpMyAdmin: `http://localhost:8080`
   - Database: `localhost:3306`
   - Redis: `localhost:6379`

### Services Overview
- **Web Server**: PHP 8.2 with Apache (Port 8000)
- **Database**: MySQL 8.3 (Port 3306)
- **Cache**: Redis 7.2 (Port 6379)
- **Database Admin**: phpMyAdmin (Port 8080)

## 🎯 Learning Outcomes

This project demonstrates proficiency in:
- **Full-stack web development** using modern PHP practices
- **Database design** and optimization with MySQL
- **Containerization** and DevOps practices with Docker
- **Security best practices** in web application development
- **Team collaboration** and version control with Git
- **MVC architecture** implementation and design patterns

## 👥 Development Team

- **Mạch Tiến Duy** - [GitHub](https://github.com/john-naeder)
- **Trần Quang Diệu** - [GitHub](https://github.com/KyoTranKMA)
- **Lê Thanh Yên** - [GitHub](https://github.com/YenLethanh129)

---

*This project was developed as part of our academic coursework, demonstrating practical application of web development principles and modern software engineering practices.*