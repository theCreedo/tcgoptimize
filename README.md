# TCG Optimize

A comprehensive toolkit designed to equip and empower TCG (Trading Card Game) players in their marketplace endeavors. Built with Laravel 9 and modern web technologies.

## 🎯 Project Vision

TCG Optimize aims to streamline the marketplace experience for TCG sellers and traders by providing essential tools for pricing, inventory management, market analysis, and automated workflows.

## ✨ Current Features

### 🔥 Discount Slasher (Enhanced)
- **Secure Price Calculation**: Apply percentage discounts to TCG card listings with XSS protection
- **Smart Input Validation**: Comprehensive server-side validation with user-friendly error messages
- **Price Statistics**: Real-time calculation of total savings, price counts, and discount summaries
- **Flexible Percentage Options**: Support for 50-100% pricing with precise 0.50 rounding
- **Error Handling**: Robust error management with detailed logging and user feedback

### 👤 User Management System
- **Enhanced User Profiles**: Support for TCG-specific information
  - TCGPlayer username integration
  - Discord username for community connections
  - Preferred currency settings (USD, CAD, EUR, GBP)
  - Timezone management
  - Email notification preferences
  - Seller level classification (casual, semi-pro, professional)
- **Business Profile Support**: Extended profiles for professional sellers
  - Business information and tax details
  - Multi-platform presence tracking
  - Address and contact management

### 🔒 Security Features
- **Input Sanitization**: XSS protection with comprehensive input filtering
- **Form Validation**: Server-side validation with custom rules and messages
- **Error Logging**: Detailed error tracking for debugging and monitoring
- **Data Integrity**: Proper database constraints and relationships

### 🏗️ Technical Architecture
- **Service-Oriented Design**: Business logic extracted to dedicated service classes
- **Dependency Injection**: Modern Laravel patterns with constructor injection
- **Type Safety**: Full type hints and return type declarations
- **Database Migrations**: Version-controlled schema with proper relationships

## 🚀 Getting Started

### Prerequisites
- PHP 8.0.2 or higher
- Composer
- Node.js & npm
- SQLite (for development) or MySQL/PostgreSQL (for production)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd tcgoptimize
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   touch database/database.sqlite  # For SQLite
   php artisan migrate
   ```

5. **Start development servers**
   ```bash
   # Terminal 1: Laravel development server
   php artisan serve

   # Terminal 2: Vite development server (for assets)
   npm run dev
   ```

6. **Access the application**
   - Laravel App: http://127.0.0.1:8000
   - Vite Dev Server: http://localhost:5173

## 🛠️ Development

### Project Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   └── DiscountController.php     # Enhanced discount calculator
│   └── Requests/
│       └── DiscountFormRequest.php    # Secure form validation
├── Models/
│   ├── User.php                       # Enhanced user model
│   └── UserProfile.php                # Business profile management
└── Services/
    └── DiscountCalculatorService.php  # Business logic service

database/
├── migrations/
│   ├── *_enhance_users_table_for_tcg_features.php
│   └── *_create_user_profiles_table.php
```

### Testing
```bash
php artisan test                    # Run all tests
php artisan test --coverage        # Run with coverage report
```

## 🗺️ Roadmap

The complete development roadmap is available in `TCG_OPTIMIZE_IMPLEMENTATION_ROADMAP.md`. Key upcoming features include:

### Phase 2: Core Market Intelligence (Weeks 5-8)
- 📊 TCGPlayer API Integration
- 📈 Real-time Price Tracking & Alerts
- 📉 Market Analysis & Trend Visualization
- 💼 Collection Management System

### Phase 3: Inventory & Sales Tools (Weeks 9-12)
- 📦 Multi-platform Inventory Management
- 🤖 Automated Repricing & Listing Tools
- 📊 Sales Analytics & Financial Reporting
- 👥 Customer Relationship Management

### Phase 4: Advanced Market Tools (Weeks 13-16)
- 🔍 Cross-platform Arbitrage Detection
- 🏆 Tournament Meta Analysis Integration
- 🔮 Predictive Price Modeling
- 🌐 Public API Development

### Phase 5: Automation & Integration (Weeks 17-20)
- ⚡ Bulk Operations & Workflow Automation
- 🛒 eBay & Facebook Marketplace Integration
- 🤖 AI-powered Recommendations
- 📈 Advanced Reporting Dashboards

## 📝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

### Development Workflow
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Commit Convention
We follow conventional commits:
- `feat:` New features
- `fix:` Bug fixes
- `docs:` Documentation updates
- `style:` Code style changes
- `refactor:` Code refactoring
- `test:` Adding tests
- `chore:` Maintenance tasks

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🤝 Acknowledgments

- Built on the Laravel framework
- Designed for the TCG community
- Inspired by the need for better marketplace tools

## 📞 Contact

- **Developer**: Eric Lee
- **Website**: [ericjmlee.com](https://www.ericjmlee.com)
- **Discord**: [@theCreedo](https://discord.com/users/thecreedo)

---

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
