
# Attendance Management System

## Overview
A modern, cloud-ready Laravel application for HR, attendance, payroll, and device management. Designed for professional organizations with advanced analytics, role-based dashboards, and multi-brand biometric device support.

## Key Features
- Employee Management & Self-Service Portal
- Attendance Tracking & Analytics (Charts, Trends)
- Leave, Overtime, Payroll Management
- Role & Permission Management (Admin/User)
- Notification Center (Read/Unread, Filters)
- Device Management (Health, Status, Multi-brand: ZKTeco, Tiposoi, Hikvision)
- Audit Logging (Security & Compliance)
- REST API for mobile/third-party integration
- Two-Factor Authentication (Admin)
- Responsive, modern UI (AdminLTE/CoreUI ready)

## Requirements
- PHP 8.0+
- Composer
- MySQL/PostgreSQL/SQLite
- Node.js & npm
- Git (for deployment)

## Local Installation
1. Clone the repository
2. Run `composer install` and `npm install`
3. Copy `.env.example` to `.env` and configure your environment
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `npm run build` (or `npm run dev` for development)
7. Start server: `php artisan serve`

## Usage
- Admin Dashboard: `/admin` (full features)
- User Dashboard: `/user` (self-service)
- Profile & Settings: `/profile`
- Device Health: `/device-health`
- Audit Logs: `/audit-logs`
- Role Management: `/roles`
- Employee Self-Service: `/self-service`

## Deployment (Render)
1. Push your code to GitHub
2. Ensure `render.yaml` is present and includes all required environment variables
3. Connect your repo to Render.com and deploy
4. **No manual environment variable setup needed in the Render dashboard—all variables are managed via `render.yaml` for automated deployment.**

## API Endpoints
- Authenticated REST API for attendance, leave, payroll (`routes/api.php`)

## Security
- Two-Factor Authentication for admin
- Audit logs for all critical actions

## Contributing
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License
MIT License
