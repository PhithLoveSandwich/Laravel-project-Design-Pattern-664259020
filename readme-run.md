-b# How to Run the Food Forum Project

This document provides the basic steps to get the Food Forum application running on your local development machine.

---

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP (and Composer)
- Node.js (and npm)
- A configured `.env` file (you can copy from `.env.example`)

---

## Running the Application

You need to run two main commands in separate terminal windows to get the application fully functional.

### 1. Start the Vite Development Server

This command compiles the frontend assets (CSS, JavaScript) and keeps watching for changes.

Open your terminal and run:
```bash
npm run dev
```

### 2. Start the PHP/Laravel Development Server

This command starts the backend server, which handles the application logic and serves the pages.

Open a **new** terminal window and run:
```bash
php artisan serve
```

Once both commands are running, you can access the application in your web browser, typically at `http://127.0.0.1:8000`.
