# SnapFood 🍔 - Laravel Multi-Vendor Restaurant App

SnapFood is a Laravel-based multi-vendor restaurant platform where different vendors can register, manage their menus, and customers can place orders from various restaurants.

## 🚀 Features
- Vendor & customer authentication
- Admin panel to manage users and restaurants
- Vendor dashboard to manage their own food items
- Multi-vendor food listing
- Responsive front-end (Blade-based)
- Cart and order functionality

## 🛠 Tech Stack
- PHP (Laravel)
- MySQL
- Blade Templating
- Tailwind


## 🔧 Installation

```bash
git clone https://github.com/yosrajalali/snapfood.git
cd snapfood
composer install
cp .env.example .env
php artisan key:generate
# Setup your DB in .env
php artisan migrate --seed
php artisan serve
