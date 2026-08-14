# SME Finance Hub - Backend API

A comprehensive financial management and bookkeeping platform designed to help Small and Medium-sized Enterprises (SMEs) manage their **cash flow, income, expenses, sales, purchases, bookkeeping, accounting records, and financial performance** from a single system.

**Backend Stack:** PHP | Slim Framework | Eloquent ORM | MySQL | Firebase JWT | PHPMailer

---

## 1. Project Overview

The **SME Cash Flow & Bookkeeping System** is a financial management application designed specifically for small and medium-sized businesses that need a simple but powerful way to understand and manage their finances.

Many SMEs record their financial activities using notebooks, spreadsheets, messaging applications, or disconnected accounting tools. This makes it difficult to maintain accurate financial records, monitor cash flow, track outstanding payments, understand profitability, and make informed business decisions.

This project aims to provide a centralized platform where a business can record and manage its financial activities while automatically maintaining the underlying bookkeeping records.

The system is built around a **double-entry accounting engine**, ensuring that financial transactions are properly recorded and can be used to generate reliable financial reports.

At its core:

> **Every financial transaction entered into the system should contribute to an accurate picture of the business's financial position and cash flow.**

---

# 2. Problem Statement

Small and medium-sized businesses frequently face challenges such as:

* Poor financial record keeping
* Lack of proper bookkeeping
* Difficulty tracking income and expenses
* Poor visibility into available cash
* Unpaid customer invoices
* Untracked supplier debts
* Difficulty reconciling bank transactions
* Inaccurate profit calculations
* Lack of financial forecasting
* Dependence on spreadsheets and manual calculations
* Difficulty generating financial reports
* Limited understanding of business financial health

These challenges can make it difficult for business owners to determine whether their businesses are actually profitable or whether they have enough cash to meet upcoming obligations.

The system addresses these problems by bringing bookkeeping, cash-flow management, sales, purchases, and financial reporting into one integrated platform.

---

# 3. Project Aim

The primary aim of this project is to develop a **centralized financial management and bookkeeping system for SMEs** that simplifies financial record keeping and provides business owners with accurate and actionable information about their finances.

The application will enable SMEs to:

* Record financial transactions
* Track income and expenses
* Manage cash and bank accounts
* Manage customers and suppliers
* Create and manage invoices
* Track customer payments
* Track supplier bills and payments
* Maintain double-entry accounting records
* Manage accounts receivable and accounts payable
* Monitor cash flow
* Generate financial reports
* Create budgets
* Track inventory
* Reconcile bank transactions
* Monitor financial performance
* Forecast future cash flow

---

# 4. Project Objectives

## 4.1 General Objective

To develop a reliable and user-friendly financial management system that enables SMEs to manage bookkeeping and monitor cash flow effectively.

## 4.2 Specific Objectives

The system aims to:

1. Provide secure user authentication and authorization.
2. Allow users to create and manage business profiles.
3. Allow businesses to manage multiple users and roles.
4. Provide a configurable chart of accounts.
5. Implement double-entry bookkeeping.
6. Record income and expenses.
7. Manage cash, bank, and mobile money accounts.
8. Manage customers and suppliers.
9. Generate and manage invoices.
10. Track accounts receivable.
11. Track accounts payable.
12. Manage products and inventory.
13. Provide budgeting functionality.
14. Support bank reconciliation.
15. Generate financial statements and accounting reports.
16. Provide cash-flow analysis.
17. Provide cash-flow forecasting.
18. Maintain an audit trail of important financial activities.
19. Provide notifications for important financial events.
20. Provide business owners with meaningful financial insights.

---

# 5. Target Users

The application is primarily intended for:

* Small business owners
* Medium-sized businesses
* Sole proprietors
* Retail businesses
* Service businesses
* Restaurants
* Fashion businesses
* Freelancers
* Agencies
* Startups
* Small trading businesses
* Accountants managing SME finances
* Business managers

The system should be designed so that users without advanced accounting knowledge can perform common financial tasks while the underlying system maintains proper accounting records.

---

# 6. Core Concept

The application is built around the following workflow:

```text
Business Activity
       ↓
Financial Transaction
       ↓
Validation
       ↓
Accounting Entry
       ↓
Debit + Credit
       ↓
General Ledger
       ↓
Financial Statements
       ↓
Cash Flow Analysis
       ↓
Business Insights
```

For example, when a business records a GH₵500 electricity expense:

```text
User records expense
        ↓
Electricity Expense = GH₵500
        ↓
Journal Entry
        ↓
Debit: Electricity Expense     GH₵500
Credit: Cash                   GH₵500
        ↓
General Ledger
        ↓
Profit & Loss
        ↓
Cash Flow
        ↓
Dashboard
```

This ensures that information does not need to be manually entered into multiple areas of the system.

---

# 7. Key Features

## 7.1 Authentication & User Management

The system will provide:

* User registration
* Login
* Logout
* Password reset
* Email verification
* User profiles
* Role-based access control
* Permissions
* Business membership

Example roles include:

* Owner
* Administrator
* Accountant
* Manager
* Cashier
* Staff
* Viewer

---

# 8. Business Management

A user can create and manage a business profile.

Business information includes:

* Business name
* Logo
* Phone number
* Email
* Address
* Country
* Currency
* Financial year
* Tax identification information
* Business status

The architecture should support a user belonging to more than one business.

---

# 9. Accounting & Bookkeeping

Accounting is the core of the application.

The system will implement **double-entry bookkeeping**.

Every financial transaction must maintain the accounting principle:

```text
Total Debits = Total Credits
```

### Example

A business makes a GH₵1,000 cash sale:

```text
Debit:
Cash                     GH₵1,000

Credit:
Sales Revenue            GH₵1,000
```

A business pays GH₵2,000 rent:

```text
Debit:
Rent Expense             GH₵2,000

Credit:
Cash                     GH₵2,000
```

The accounting engine will form the foundation for:

* General ledger
* Trial balance
* Profit & loss
* Balance sheet
* Cash-flow statements
* Financial analysis

---

# 10. Chart of Accounts

Each business will have its own chart of accounts.

The main account categories are:

```text
Assets
Liabilities
Equity
Revenue
Expenses
```

Example:

```text
1000 Assets
├── 1100 Cash
├── 1200 Bank
├── 1300 Accounts Receivable
├── 1400 Inventory
└── 1500 Equipment

2000 Liabilities
├── 2100 Accounts Payable
├── 2200 Loans
└── 2300 Taxes Payable

3000 Equity
├── 3100 Owner Capital
├── 3200 Retained Earnings
└── 3300 Drawings

4000 Revenue
├── 4100 Sales
└── 4200 Service Revenue

6000 Expenses
├── 6100 Rent
├── 6200 Utilities
├── 6300 Transport
├── 6400 Salaries
└── 6500 Marketing
```

Businesses should be able to customize their accounts.

---

# 11. Income Management

Businesses can record income from:

* Product sales
* Services
* Other income
* Interest
* Investments
* Other business activities

Each income record can contain:

* Date
* Amount
* Customer
* Account
* Payment method
* Reference
* Description
* Attachment
* Notes

---

# 12. Expense Management

The system allows businesses to record expenses such as:

* Rent
* Electricity
* Water
* Internet
* Transportation
* Fuel
* Salaries
* Marketing
* Office supplies
* Repairs
* Software subscriptions
* Bank charges
* Inventory purchases

Users can attach receipts or supporting documents to expenses.

---

# 13. Cash Management

Cash management is one of the primary components of the system.

The application should support:

* Cash accounts
* Bank accounts
* Mobile Money accounts
* Petty cash
* Digital wallets
* Transfers between accounts
* Cash deposits
* Cash withdrawals

Example:

```text
Main Cash        GH₵5,000
Bank Account     GH₵12,000
MTN MoMo         GH₵3,500
-------------------------
Total Cash       GH₵20,500
```

Transfers between accounts should not be treated as income or expenses.

For example:

```text
Bank → Cash

Debit:  Cash       GH₵1,000
Credit: Bank       GH₵1,000
```

---

# 14. Customer Management

Businesses can create customer records containing:

* Customer name
* Phone number
* Email
* Address
* Tax ID
* Credit limit
* Opening balance
* Status
* Transaction history

The customer profile should provide a complete view of:

* Invoices
* Payments
* Outstanding balance
* Overdue amounts
* Transaction history

---

# 15. Invoicing

Businesses can create professional invoices.

Invoices contain:

* Invoice number
* Customer
* Invoice date
* Due date
* Products/services
* Quantity
* Unit price
* Discount
* Tax
* Total
* Payment status
* Notes

Invoice statuses include:

```text
Draft
Sent
Partially Paid
Paid
Overdue
Cancelled
```

The system should support:

* PDF invoices
* Invoice sharing
* Payment tracking
* Partial payments
* Recurring invoices
* Payment reminders

---

# 16. Accounts Receivable

Accounts receivable tracks money owed to the business by customers.

The system should show:

* Outstanding invoices
* Paid invoices
* Partially paid invoices
* Overdue invoices
* Customer balances
* Payment history
* Receivables aging

Example:

```text
0–30 Days       GH₵4,500
31–60 Days      GH₵2,100
61–90 Days      GH₵1,200
90+ Days          GH₵800
-------------------------
Total           GH₵8,600
```

---

# 17. Supplier Management

Businesses can manage suppliers and vendors.

Supplier information includes:

* Name
* Phone
* Email
* Address
* Tax ID
* Payment terms
* Opening balance
* Status

---

# 18. Bills & Accounts Payable

Businesses can record bills received from suppliers.

The system will track:

* Bill number
* Supplier
* Bill date
* Due date
* Items
* Taxes
* Discounts
* Total amount
* Amount paid
* Outstanding balance
* Payment status

Accounts payable allows the business to understand how much money it owes suppliers.

---

# 19. Inventory Management

For businesses that sell physical products, the application will support inventory management.

Features include:

* Products
* Product categories
* SKUs
* Selling prices
* Cost prices
* Stock quantities
* Reorder levels
* Stock adjustments
* Stock purchases
* Stock sales
* Returns
* Damaged stock
* Inventory valuation

Inventory movements should be recorded as transactions.

```text
Purchase
   ↓
Stock increases

Sale
   ↓
Stock decreases

Return
   ↓
Stock increases

Damage
   ↓
Stock decreases
```

Inventory should also integrate with accounting to calculate cost of goods sold.

---

# 20. Bank Management

Businesses can link or manually manage bank accounts.

Features include:

* Bank account management
* Bank statement import
* Transaction matching
* Reconciliation
* Unmatched transaction detection
* Duplicate detection
* Reconciliation reports

Possible import formats include:

* CSV
* Excel
* OFX

---

# 21. Bank Reconciliation

Bank reconciliation compares the transactions recorded by the application with transactions appearing in a bank statement.

Workflow:

```text
Import Bank Statement
        ↓
Read Bank Transactions
        ↓
Match Existing Transactions
        ↓
Identify Unmatched Transactions
        ↓
User Reviews
        ↓
Reconcile
        ↓
Generate Reconciliation Report
```

---

# 22. Budgeting

Businesses can create budgets for different periods.

Example:

```text
Marketing Budget

Budget:       GH₵2,000
Actual:       GH₵2,300
Variance:      -GH₵300
```

The system should support:

* Monthly budgets
* Quarterly budgets
* Annual budgets
* Category-based budgets
* Budget vs actual reports
* Budget alerts

---

# 23. Financial Reports

The system should generate professional financial reports.

### Profit & Loss

Shows:

```text
Revenue
- Cost of Goods Sold
= Gross Profit

- Operating Expenses
= Net Profit
```

### Balance Sheet

Shows:

```text
Assets
Liabilities
Equity
```

### Cash Flow Statement

Shows:

```text
Operating Activities
Investing Activities
Financing Activities
```

### Other reports

* General Ledger
* Trial Balance
* Cash Book
* Sales Report
* Expense Report
* Accounts Receivable
* Accounts Payable
* Customer Statements
* Supplier Statements
* Budget vs Actual
* Tax Reports
* Inventory Reports

---

# 24. Cash Flow Management

Cash flow is a major focus of this application.

The system will track:

### Cash inflows

* Sales
* Customer payments
* Loans
* Investments
* Other income

### Cash outflows

* Purchases
* Supplier payments
* Salaries
* Rent
* Utilities
* Taxes
* Loan repayments
* Other expenses

The fundamental calculation is:

```text
Opening Cash
+ Cash Inflows
- Cash Outflows
-----------------
Closing Cash
```

The dashboard should provide a clear visual representation of the movement of cash.

---

# 25. Cash Flow Forecasting

The application can use historical and expected financial information to estimate future cash flow.

Forecasting can consider:

* Historical income
* Historical expenses
* Recurring expenses
* Outstanding invoices
* Expected customer payments
* Upcoming supplier bills
* Loan payments
* Budget information
* Seasonal trends

Example:

```text
Current Cash          GH₵15,000
Expected Receivables  +GH₵12,000
Expected Expenses     -GH₵8,500
Upcoming Bills        -GH₵4,000
--------------------------------
Projected Cash        GH₵14,500
```

The system can warn the user when projected cash levels become dangerously low.

---

# 26. Tax Management

The system should provide configurable tax functionality.

Features include:

* Tax rates
* Tax categories
* Tax on sales
* Tax on purchases
* Tax summaries
* Tax reports
* Tax liabilities

Tax rules should remain configurable so that the application can adapt to changes in tax regulations.

---

# 27. Fixed Asset Management

Businesses can track assets such as:

* Computers
* Vehicles
* Equipment
* Furniture
* Machinery
* Property

Asset information includes:

* Purchase date
* Purchase cost
* Useful life
* Residual value
* Depreciation method
* Accumulated depreciation
* Current value
* Disposal status

---

# 28. Loan Management

The system can track business loans.

Information includes:

* Lender
* Loan reference
* Principal amount
* Interest rate
* Loan date
* Maturity date
* Payment frequency
* Outstanding balance

Loan payments can be divided into:

```text
Principal
Interest
Total Payment
```

---

# 29. Notifications

The system should notify users about important financial events.

Examples:

```text
⚠️ Invoice overdue

Invoice INV-0012 is 7 days overdue.

--------------------------------

⚠️ Low projected cash

Your projected cash balance may fall below
GH₵2,000 next month.

--------------------------------

🔔 Upcoming payment

Supplier payment of GH₵3,500 is due in 3 days.
```

---

# 30. Audit Trail

Because the application handles financial information, important changes must be traceable.

The system should record:

* Who performed an action
* What action was performed
* When it occurred
* Which record was affected
* Previous values
* New values

Example:

```text
User: Accountant
Action: UPDATE
Record: Invoice
ID: 1024

Old Amount: GH₵1,500
New Amount: GH₵1,800

Date: 10/08/2026
```

Financial records should preferably be **voided or reversed rather than permanently deleted**, preserving the accounting history.

---

# 31. Document & Receipt Management

Users can attach documents to financial records.

Supported documents may include:

* Receipts
* Invoices
* Bills
* Bank statements
* Contracts
* Purchase documents
* Other financial documents

The system should maintain relationships between documents and the relevant financial records.

---

# 32. Dashboard

The dashboard provides a high-level overview of the business.

Key metrics include:

```text
Cash Balance
Revenue
Expenses
Profit
Accounts Receivable
Accounts Payable
Outstanding Invoices
Upcoming Payments
```

The dashboard should also display:

* Cash-flow charts
* Revenue trends
* Expense trends
* Profit trends
* Recent transactions
* Upcoming payments
* Overdue invoices
* Budget performance

---

# 33. Financial Health Analysis

The system can eventually provide a simplified financial-health score.

Possible indicators:

```text
Cash Flow
Profitability
Debt
Receivables
Expenses
Liquidity
```

Example:

```text
Financial Health

████████░░ 82%

Cash Flow       90%
Profitability   80%
Debt            70%
Receivables     88%
Expenses        80%
```

This feature is intended to help non-accountants understand the financial condition of their businesses.

---

# 34. Future AI Features

An optional future version can include an AI financial assistant.

Users could ask questions such as:

> How much did I spend on transportation this month?

> Which customers owe me the most money?

> Why has my cash flow decreased?

> What were my most expensive categories this year?

> Can I afford a GH₵10,000 purchase next month?

The AI assistant should work with the application's verified financial data rather than generate unsupported financial information.

---

# 35. System Architecture

The application follows a layered architecture.

```text
┌─────────────────────────────┐
│          Frontend           │
│       React / Vite          │
└──────────────┬──────────────┘
               │
               │ REST API
               ↓
┌─────────────────────────────┐
│           Backend           │
│       PHP / Slim API        │
├─────────────────────────────┤
│ Controllers                 │
│ Services                    │
│ Validation                  │
│ Business Logic              │
│ Accounting Engine           │
└──────────────┬──────────────┘
               │
               ↓
┌─────────────────────────────┐
│          Database           │
│        MySQL/MariaDB        │
└─────────────────────────────┘
```

The backend should separate:

```text
Routes
   ↓
Controllers
   ↓
Services
   ↓
Repositories / Models
   ↓
Database
```

Accounting logic should reside primarily within dedicated services rather than being duplicated across controllers.

---

# 36. Database Architecture

The database is divided into several functional areas.

```text
Authentication
├── users
├── roles
├── permissions
└── role_permissions

Business
├── businesses
└── business_users

Accounting
├── account_types
├── accounts
├── fiscal_periods
├── journal_entries
└── journal_entry_lines

Transactions
└── transactions

Cash & Banking
├── cash_accounts
├── cash_transactions
├── transfers
├── bank_accounts
├── bank_transactions
├── reconciliations
└── reconciliation_items

Sales
├── customers
├── invoices
├── invoice_items
└── invoice_payments

Purchases
├── suppliers
├── bills
├── bill_items
└── bill_payments

Inventory
├── product_categories
├── products
├── stock
└── inventory_transactions

Budgeting
├── budgets
└── budget_items

Tax
├── tax_rates
└── tax_transactions

Assets & Financing
├── fixed_assets
├── loans
└── loan_payments

System
├── notifications
├── audit_logs
└── attachments
```

---

# 37. Core Accounting Data Flow

The accounting engine is the central source of financial truth.

```text
                    Business Activity
                           │
                           ↓
                    User Transaction
                           │
                           ↓
                     Validation
                           │
                           ↓
                    Journal Entry
                           │
                    ┌──────┴──────┐
                    ↓             ↓
                  Debit         Credit
                    │             │
                    └──────┬──────┘
                           ↓
                  Journal Entry Lines
                           │
                           ↓
                       Accounts
                           │
             ┌─────────────┼─────────────┐
             ↓             ↓             ↓
       General Ledger  Trial Balance  Account Balances
             │
             ↓
       Financial Reports
             │
       ┌─────┼──────────────┐
       ↓     ↓              ↓
      P&L  Balance Sheet  Cash Flow
```

---

# 38. Main Database Entities

---

# 39. API Documentation

## 39.1 Base URL

```
http://localhost:8000/api
```

## 39.2 Response Format

All API responses are in JSON format with the following structure:

### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": {}
}
```

### Error Response
```json
{
  "error": true,
  "message": "Error description"
}
```

---

## 39.3 Authentication Endpoints

### 39.3.1 User Registration

**Endpoint:** `POST /auth/register`

**Description:** Create a new user account

**Request Body:**
```json
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "john@example.com",
  "phone_number": "+233123456789",
  "password": "SecurePass@123",
  "user_role_id": 1
}
```

**Validation Rules:**
- First Name & Last Name: Must contain only letters, spaces, or hyphens
- Email: Must be a valid email format (example@domain.com)
- Password: Minimum 8 characters, must include:
  - Uppercase letters (A-Z)
  - Lowercase letters (a-z)
  - Numbers (0-9)
  - Special characters (@$!%*?&)

**Success Response (200):**
```json
{
  "success": true,
  "message": "User account created successfully"
}
```

**Error Response (400):**
```json
{
  "error": true,
  "message": "Error message describing validation failure"
}
```

**Possible Errors:**
- Names should only contain letters, spaces, or hyphens
- Enter a valid email address e.g. example@domain.com
- Sorry, email taken by another user
- Password should be at least 8 characters and have an uppercase, lowercase, number, and special character

---

### 39.3.2 Email Verification

**Endpoint:** `GET /auth/verify_email/{encoded_url}`

**Description:** Verify user email address

**URL Parameters:**
- `encoded_url` (string, required): Base64 encoded email address

**Example:**
```
GET /auth/verify_email/am9obkBleGFtcGxlLmNvbQ==
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Email verification successful"
}
```

**Error Response (400):**
```json
{
  "error": true,
  "message": "Email not verified. Contact customer support for further assistance"
}
```

---

### 39.3.3 User Login

**Endpoint:** `POST /auth/login`

**Description:** Authenticate user and generate session

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "SecurePass@123"
}
```

**Validation Rules:**
- Email must be valid format
- User account must exist
- Email must be verified
- Password must match stored password

**Success Response (200):**
```json
{
  "success": true,
  "message": "Login successful"
}
```

**Error Response (400):**
```json
{
  "error": true,
  "message": "Error message describing login failure"
}
```

**Possible Errors:**
- Enter a valid email address e.g. example@domain.com
- Sorry, user account does not exist. Register new account
- User email is not verified. Check your spam for verification email or contact customer support
- Email and password are not a match

---

### 39.3.4 Forgot Password

**Endpoint:** `POST /auth/forgot_password`

**Description:** Request password reset token via email

**Request Body:**
```json
{
  "email": "john@example.com"
}
```

**Validation Rules:**
- Email must be valid format
- User account must exist

**Success Response (200):**
```json
{
  "success": true,
  "message": "If an account exists for this email, a password reset link has been sent."
}
```

**Note:** Response is same whether account exists or not for security reasons

**Error Response (400):**
```json
{
  "error": true,
  "message": "User email is invalid. Email should be in the form example@domain.com"
}
```

---

### 39.3.5 Update Password

**Endpoint:** `POST /auth/update_password`

**Description:** Update user password after reset

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "NewSecurePass@123"
}
```

**Validation Rules:**
- Email must be valid format
- User account must exist
- Password must meet complexity requirements:
  - Minimum 8 characters
  - Uppercase, lowercase, number, and special character (@$!%*?&)

**Success Response (200):**
```json
{
  "success": true,
  "message": "Password updated successfully"
}
```

**Error Response (400):**
```json
{
  "error": true,
  "message": "Error message describing failure"
}
```

**Possible Errors:**
- Enter a valid email address e.g. example@domain.com
- Sorry, user account does not exist. Register new account
- Password should be at least 8 characters and have an uppercase, lowercase, number, and special character

---

## 39.4 CORS Support

The API supports Cross-Origin Resource Sharing (CORS) for the following origins:

- `http://localhost:5173` (Frontend Development)
- `http://100.115.149.56:5173`
- `http://10.195.128.9:5173`
- `http://10.195.128.9`

All requests from these origins are allowed with the following methods:
- GET, POST, PUT, DELETE, OPTIONS

---

## 39.5 Status Codes

| Status Code | Meaning |
|-------------|---------|
| 200 | OK - Request successful |
| 400 | Bad Request - Validation or input error |
| 401 | Unauthorized - Authentication required |
| 403 | Forbidden - Access denied |
| 404 | Not Found - Resource not found |
| 500 | Internal Server Error |

---

# 40. Project Structure

```
sme_finance_hub_backend/
├── src/
│   ├── Controllers/
│   │   └── AuthController.php          # Authentication logic
│   ├── Models/
│   │   ├── UsersModel.php             # User data model
│   │   ├── UserRolesModel.php         # User roles model
│   │   ├── AuthTokensModel.php        # Authentication tokens
│   │   └── BusinessesModel.php        # Business data model
│   ├── Routes/
│   │   └── AuthRoute.php              # Authentication routes
│   ├── Utilities/
│   │   ├── MailFunctions.php          # Email sending utilities
│   │   └── JWTFirebase.php            # JWT token management
│   ├── database.php                   # Database configuration
│   └── routes.php                     # Route registration
├── public/
│   └── index.php                      # Application entry point
├── docker/
│   ├── nginx/
│   │   └── default.conf               # Nginx configuration
│   └── php/
│       └── php.ini                    # PHP configuration
├── docker-compose.yml                 # Docker compose setup
├── Dockerfile                         # Docker image definition
├── Makefile                           # Make commands
├── composer.json                      # PHP dependencies
└── README.md                          # Project documentation
```

---

# 41. Environment Variables

Create a `.env` file in the project root with the following variables:

```env
# Database Configuration
DB_DRIVER=mysql
DB_HOST=db
DB_PORT=3306
DB_NAME=sme_finance_hub
DB_USERNAME=root
DB_PASSWORD=password
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci

# SMTP Configuration (Email)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password
MAIL_FROM=noreply@smefinancehub.com
MAIL_FROM_NAME=SME Finance Hub
MAIL_REPLY_TO=support@smefinancehub.com

# JWT Configuration
JWT_SECRET_KEY=your-secret-key-here-change-in-production
```

---

# 42. Getting Started

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Composer
- Docker & Docker Compose (optional)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd sme_finance_hub_backend
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Create .env file**
   ```bash
   cp .env.example .env
   ```

4. **Run database migrations** (when ready)
   ```bash
   php bin/migrate
   ```

5. **Start the application**
   ```bash
   php -S localhost:8000 -t public
   ```

### Running with Docker

```bash
docker-compose up -d
```

Access the API at: `http://localhost:8000`

---

# 43. Development Guidelines

## Code Standards
- Follow PSR-12 coding standards
- Use type hints in function declarations
- Document public methods with PHPDoc comments
- Keep methods focused and single-responsibility

## Security
- All user inputs must be validated
- Passwords are hashed using PASSWORD_DEFAULT
- Environment variables store sensitive data
- CSRF protection via token validation (when implemented)

## Email Templates
Email templates are located in `src/Templates/emails/`. Current templates:
- `verification.php` - Email verification template
- `password-reset.php` - Password reset template

---

# 44. Upcoming Features

### Short Term
- [ ] Business profile management
- [ ] User role and permission management
- [ ] Multi-user support per business
- [ ] JWT token-based authentication
- [ ] Account/Chart of Accounts management

### Medium Term
- [ ] Transaction recording (income/expenses)
- [ ] Invoice management
- [ ] Customer and supplier management
- [ ] Bank account management
- [ ] Financial reporting

### Long Term
- [ ] Double-entry bookkeeping engine
- [ ] Advanced financial analysis
- [ ] Forecasting capabilities
- [ ] Mobile application
- [ ] Advanced reporting dashboard

---

# 45. Support & Contribution

For issues, feature requests, or contributions, please contact the development team or submit a GitHub issue.

**Last Updated:** August 14, 2026

The initial complete database consists of approximately 40+ core tables covering:

* Users
* Businesses
* Roles
* Permissions
* Accounts
* Accounting periods
* Journal entries
* Transactions
* Cash accounts
* Bank accounts
* Customers
* Invoices
* Suppliers
* Bills
* Products
* Inventory
* Budgets
* Taxes
* Assets
* Loans
* Notifications
* Audit logs
* Attachments

The database is designed to be modular so additional features can be added without redesigning the entire system.

---

# 39. Development Roadmap

Development should be performed incrementally.

## Phase 1 — Foundation

* Project setup
* Database setup
* Authentication
* User management
* Business management
* Roles and permissions

## Phase 2 — Accounting Core

* Chart of accounts
* Account types
* Fiscal periods
* Journal entries
* Journal entry lines
* Double-entry validation
* General ledger

## Phase 3 — Transactions

* Income
* Expenses
* Transaction management
* Cash accounts
* Transfers
* Transaction history

## Phase 4 — Dashboard

* Cash balance
* Revenue
* Expenses
* Profit
* Recent transactions
* Cash-flow visualization

## Phase 5 — Sales

* Customers
* Products/services
* Invoices
* Invoice items
* Payments
* Accounts receivable

## Phase 6 — Purchases

* Suppliers
* Bills
* Bill items
* Payments
* Accounts payable

## Phase 7 — Financial Reports

* Trial balance
* General ledger
* Profit & loss
* Balance sheet
* Cash-flow statement
* Customer statements
* Supplier statements

## Phase 8 — Inventory

* Products
* Categories
* Stock
* Stock movements
* Inventory valuation
* Cost of goods sold

## Phase 9 — Advanced Financial Management

* Budgeting
* Bank reconciliation
* Tax management
* Fixed assets
* Loans

## Phase 10 — Intelligence

* Financial health score
* Cash-flow forecasting
* Automated alerts
* Advanced analytics
* AI financial assistant

---

# 40. MVP Scope

The first production-ready version should **not attempt to implement every feature**.

The recommended MVP consists of:

```text
Authentication
        ↓
Business Management
        ↓
Users & Roles
        ↓
Chart of Accounts
        ↓
Double-Entry Accounting
        ↓
Income & Expenses
        ↓
Cash Management
        ↓
Customers
        ↓
Invoices
        ↓
Payments
        ↓
Suppliers
        ↓
Bills
        ↓
Accounts Receivable / Payable
        ↓
General Ledger
        ↓
Trial Balance
        ↓
Profit & Loss
        ↓
Balance Sheet
        ↓
Cash Flow Statement
        ↓
Dashboard
```

This provides a complete and meaningful accounting and cash-flow system without making the first release unnecessarily complicated.

---

# 41. Future Enhancements

Future versions may introduce:

* Mobile applications
* Bank API integrations
* Mobile Money integrations
* Payment gateway integrations
* Automated receipt OCR
* Automated transaction categorization
* Multi-currency accounting
* Multi-branch management
* Payroll
* Advanced inventory
* Automated tax filing support
* Advanced financial forecasting
* AI-powered financial analysis
* Financial recommendations
* Business performance benchmarking

---

# 42. Security Requirements

Because the system handles sensitive financial information, security is a major requirement.

The application should implement:

* Secure password hashing
* Authentication tokens/sessions
* Role-based access control
* Permission-based authorization
* Input validation
* SQL injection protection
* API authentication
* HTTPS
* Secure file uploads
* Audit logging
* Rate limiting
* Secure password reset
* Database backups
* Protection against unauthorized business access

Users must only be able to access data belonging to businesses they are authorized to access.

---

# 43. Data Integrity Requirements

The accounting engine must enforce financial consistency.

Important rules include:

### Double-entry balance

```text
Total Debits = Total Credits
```

### Transaction ownership

Every business transaction must belong to a valid business.

### Account ownership

A user should not be able to post transactions to another business's accounts.

### Closed periods

Transactions should not be modified in a closed fiscal period without appropriate authorization.

### Financial history

Financial records should not be permanently deleted without proper accounting controls.

### Auditability

Important changes must be traceable to a user and timestamp.

---

# 44. Expected Benefits

The completed system should provide SMEs with:

### Better financial organization

All financial records are stored in one centralized platform.

### Better cash-flow visibility

Business owners can immediately see how much money is available and where it is going.

### Better bookkeeping

Transactions are automatically reflected in the accounting system.

### Better decision-making

Reports and analytics help owners understand business performance.

### Reduced manual work

Invoices, payments, transactions, and accounting entries can be connected automatically.

### Improved financial control

Budgets, alerts, reconciliation, and audit trails reduce financial errors.

### Better forecasting

Businesses can anticipate future cash shortages and financial obligations.

---

# 45. Project Success Criteria

The project will be considered successful when a business owner can:

1. Register an account.
2. Create a business.
3. Set up a chart of accounts.
4. Record income.
5. Record expenses.
6. Manage cash accounts.
7. Create customers.
8. Create invoices.
9. Record customer payments.
10. Create suppliers.
11. Record supplier bills.
12. Record supplier payments.
13. Automatically generate balanced accounting entries.
14. View the general ledger.
15. Generate a trial balance.
16. Generate a profit & loss statement.
17. Generate a balance sheet.
18. Generate a cash-flow statement.
19. View current cash position.
20. Review financial activity from the dashboard.

The system should produce consistent results across all modules.

---

# 46. Long-Term Vision

The long-term goal is to develop the system into a **complete SME financial operating platform** rather than simply an accounting application.

The platform should eventually help a business answer three fundamental questions:

### 1. Where is my money?

Through:

* Cash management
* Bank accounts
* Mobile Money
* Transactions
* Reconciliation

### 2. How is my business performing?

Through:

* Revenue
* Expenses
* Profit
* Financial statements
* KPIs
* Budgets

### 3. What is likely to happen next?

Through:

* Cash-flow forecasting
* Upcoming bills
* Expected receivables
* Budget analysis
* Financial health indicators
* AI-powered insights

Ultimately, the system should transform raw financial transactions into **clear, understandable information that enables SME owners to make better financial decisions.**

---

# 47. Project Philosophy

The application should follow five core principles:

### Simplicity

Accounting should be understandable to ordinary business owners.

### Accuracy

Financial information must be consistent and mathematically correct.

### Transparency

Every important financial action should be traceable.

### Automation

Users should enter information once and allow the system to process it across the relevant modules.

### Actionable Information

The system should not simply tell users what happened; it should help them understand **what it means for their business**.

---

## Conclusion

The **SME Cash Flow & Bookkeeping System** is designed to bridge the gap between traditional bookkeeping and modern financial management.

Rather than functioning as a simple expense tracker, the application combines:

```text
                 SME FINANCIAL SYSTEM
                         │
        ┌────────────────┼────────────────┐
        ↓                ↓                ↓
   BOOKKEEPING       CASH FLOW        BUSINESS DATA
        │                │                │
        ↓                ↓                ↓
  Double Entry       Cash Tracking     Sales
  General Ledger     Forecasting       Purchases
  Trial Balance      Analysis          Customers
  Financial Reports  Alerts            Suppliers
        │                │                │
        └────────────────┼────────────────┘
                         ↓
                  BUSINESS INSIGHTS
                         ↓
                BETTER DECISIONS
```

The ultimate objective is to give SMEs a **single source of truth for their finances**, allowing them to maintain proper bookkeeping while gaining a clear understanding of their current financial position, cash flow, profitability, and future financial outlook.
