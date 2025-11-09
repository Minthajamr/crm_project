---

## 💻 Code Examples

### Basic CRUD Operations

#### Create a Contact
```php
use App\Models\Contact;

$contact = Contact::create([
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'email' => 'jane.smith@example.com',
    'phone' => '+1234567890',
    'company' => 'Tech Solutions Ltd',
    'position' => 'CTO',
    'status' => 'active'
]);
```

#### Update Contact Information
```php
$contact->update([
    'phone' => '+0987654321',
    'notes' => 'Key decision maker for Q4 projects'
]);
```

#### Search Contacts
```php
$contacts = Contact::where('company', 'like', '%Tech%')
    ->orWhere('email', 'like', '%@example.com')
    ->get();
```

### Working with Deals

#### Create a Deal with Pipeline
```php
use App\Models\Deal;

$deal = Deal::create([
    'title' => 'Website Redesign Project',
    'value' => 25000,
    'currency' => 'USD',
    'stage' => 'proposal',
    'probability' => 60,
    'contact_id' => $contact->id,
    'user_id' => auth()->id(),
    'expected_close_date' => now()->addDays(45)
]);
```

#### Move Deal Through Pipeline
```php
$deal->moveToStage('negotiation');
// or
$deal->update(['stage' => 'won', 'closed_at' => now()]);
```

#### Calculate Deal Statistics
```php
$totalValue = Deal::where('stage', 'won')
    ->sum('value');

$averageDealSize = Deal::where('stage', 'won')
    ->avg('value');

$conversionRate = Deal::conversionRate(); // Custom scope
```

### Activity Tracking

#### Log a Call Activity
```php
use App\Models\Activity;

Activity::create([
    'type' => 'call',
    'subject' => 'Initial consultation call',
    'description' => 'Discussed project requirements and timeline',
    'contact_id' => $contact->id,
    'deal_id' => $deal->id,
    'duration' => 30, // minutes
    'completed_at' => now()
]);
```

#### Schedule a Meeting
```php
$meeting = Activity::create([
    'type' => 'meeting',
    'subject' => 'Product demo',
    'scheduled_at' => now()->addDays(3)->setTime(14, 0),
    'contact_id' => $contact->id,
    'location' => 'Zoom',
    'reminder_at' => now()->addDays(3)->setTime(13, 30)
]);
```

#### Get Upcoming Activities
```php
$upcoming = Activity::where('user_id', auth()->id())
    ->whereNull('completed_at')
    ->where('scheduled_at', '>=', now())
    ->orderBy('scheduled_at')
    ->get();
```

### API Usage

#### Authentication
```php
// Get API Token
$token = auth()->user()->createToken('api-token')->plainTextToken;
```

#### API Request Example (cURL)
```bash
curl -X GET "https://yourcrm.com/api/contacts" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

#### API Request Example (PHP)
```php
$response = Http::withToken($token)
    ->get('https://yourcrm.com/api/contacts', [
        'status' => 'active',
        'limit' => 50
    ]);

$contacts = $response->json();
```

### Email Integration

#### Send Email from CRM
```php
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

Mail::to($contact->email)->send(
    new ContactEmail($contact, $template, $data)
);

// Log the email activity
Activity::create([
    'type' => 'email',
    'subject' => 'Welcome Email Sent',
    'contact_id' => $contact->id,
    'completed_at' => now()
]);
```

### Custom Reports

#### Sales Performance Report
```php
use App\Models\Deal;
use Carbon\Carbon;

$report = Deal::selectRaw('
        DATE_FORMAT(closed_at, "%Y-%m") as month,
        COUNT(*) as total_deals,
        SUM(value) as total_revenue,
        AVG(value) as average_deal_size
    ')
    ->where('stage', 'won')
    ->whereBetween('closed_at', [
        Carbon::now()->subMonths(6),
        Carbon::now()
    ])
    ->groupBy('month')
    ->orderBy('month', 'desc')
    ->get();
```

#### Lead Conversion Funnel
```php
$funnel = [
    'leads' => Contact::where('status', 'lead')->count(),
    'qualified' => Contact::where('status', 'qualified')->count(),
    'proposal' => Deal::where('stage', 'proposal')->count(),
    'negotiation' => Deal::where('stage', 'negotiation')->count(),
    'won' => Deal::where('stage', 'won')->count(),
];

$conversionRate = ($funnel['won'] / $funnel['leads']) * 100;
```

---# 🚀 CRM System

> A modern, powerful Customer Relationship Management system built with Laravel

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

---

## ✨ Features

- 📊 **Dashboard Analytics** - Real-time insights into your customer data
- 👥 **Contact Management** - Organize and track all customer interactions
- 📈 **Sales Pipeline** - Visual pipeline to manage deals and opportunities
- 📧 **Email Integration** - Send and track emails directly from the system
- 📱 **Mobile Responsive** - Access your CRM anywhere, anytime
- 🔒 **Secure & Reliable** - Built with Laravel's robust security features
- 🎨 **Modern UI** - Clean, intuitive interface built with Tailwind CSS
- 📝 **Activity Tracking** - Complete audit trail of all customer interactions

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11.x
- **Frontend:** Blade Templates + Tailwind CSS
- **Database:** MySQL / PostgreSQL
- **Authentication:** Laravel Breeze/Sanctum
- **Real-time:** Laravel Echo + Pusher

---

## 📋 Requirements

Before you begin, ensure you have the following installed:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Git

---

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/crm-system.git
cd crm-system
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_database
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Database Migration

```bash
php artisan migrate --seed
```

### 5. Build Assets

```bash
npm run dev
```

### 6. Start the Server

```bash
php artisan serve
```

Visit `http://localhost:8000` and start managing your customers! 🎉

---

## 📸 Screenshots

### Dashboard
![Dashboard](docs/images/dashboard.png)

### Contact Management
![Contacts](docs/images/contacts.png)

### Sales Pipeline
![Pipeline](docs/images/pipeline.png)

---

## 🎯 Key Modules

### 👤 Contacts
Manage all your customer contacts with detailed profiles, custom fields, and interaction history.

```php
// Example: Creating a new contact
$contact = Contact::create([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
    'phone' => '+1234567890',
    'company' => 'Acme Corp'
]);
```

### 💼 Deals
Track sales opportunities through customizable pipeline stages with drag-and-drop functionality.

```php
// Example: Creating a deal
$deal = Deal::create([
    'title' => 'Enterprise License',
    'value' => 50000,
    'stage' => 'negotiation',
    'contact_id' => $contact->id,
    'expected_close_date' => now()->addDays(30)
]);
```

### 📅 Activities
Log calls, meetings, emails, and notes. Never miss a follow-up with activity reminders.

```php
// Example: Logging an activity
Activity::create([
    'type' => 'call',
    'subject' => 'Follow-up call',
    'contact_id' => $contact->id,
    'scheduled_at' => now()->addDays(1),
    'notes' => 'Discuss pricing options'
]);
```

### 📊 Reports
Generate detailed reports and analytics to gain insights into your sales performance.

```php
// Example: Generate sales report
$report = Report::salesByMonth()
    ->whereBetween('created_at', [now()->startOfMonth(), now()])
    ->sum('value');
```

### ⚙️ Settings
Customize fields, pipeline stages, user permissions, and system preferences.

```php
// Example: Update system settings
Setting::set('currency', 'USD');
Setting::set('timezone', 'America/New_York');
Setting::set('date_format', 'Y-m-d');
```

---

## 🔐 Default Credentials

After running migrations with seed data:

- **Email:** admin@crm.com
- **Password:** password

> ⚠️ **Important:** Change these credentials immediately in production!

---

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

Run with coverage:

```bash
php artisan test --coverage
```

---

## 📚 Documentation

For detailed documentation, visit our [Wiki](https://github.com/yourusername/crm-system/wiki) or check the `docs/` folder.

- [Installation Guide](docs/installation.md)
- [User Manual](docs/user-guide.md)
- [API Documentation](docs/api.md)
- [Development Guide](docs/development.md)

---

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 🐛 Bug Reports

If you discover a bug, please create an issue on GitHub with:

- Detailed description of the issue
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)
- Environment details (PHP version, Laravel version, etc.)

---

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for a list of changes.

---

## 🔒 Security

If you discover any security-related issues, please email security@yourcrm.com instead of using the issue tracker.

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 💖 Acknowledgments

- Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- UI components by [Tailwind CSS](https://tailwindcss.com)
- Icons from [Heroicons](https://heroicons.com)
- Inspired by modern CRM solutions

---

## 👥 Team

- **Your Name** - *Lead Developer* - [@yourhandle](https://github.com/yourhandle)

---

## 📞 Support

Need help? Reach out to us:

- 📧 Email: support@yourcrm.com
- 💬 Discord: [Join our community](https://discord.gg/yourserver)
- 🐦 Twitter: [@yourcrm](https://twitter.com/yourcrm)
- 📖 Documentation: [docs.yourcrm.com](https://docs.yourcrm.com)

---

<div align="center">

**⭐ Star this repo if you find it helpful!**

Made with ❤️ by [Your Team Name]

[Website](https://yourcrm.com) • [Demo](https://demo.yourcrm.com) • [Docs](https://docs.yourcrm.com)

</div>
