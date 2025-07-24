# 📝 Task Manager

A simple, Trello-like Task Manager built with Laravel. Users can register, log in with roles, and create tasks. All users can add tasks, but only admins can assign them to others. Tasks can be dragged, sorted by priority, and managed easily through a clean UI.

## ✨ Features

-   User Registration and Login
-   User Roles (Admin, Normal User)
-   All users can add tasks
-   Only Admin can assign tasks to others
-   Drag and Drop task interface
-   Sort tasks by priority

## 🧰 Packages Used

-   **[Eloquent-Sluggable](https://github.com/cviebrock/eloquent-sluggable)** – Use for unique slug generate
-   **[Laravel Breeze](https://github.com/laravel/breeze)** – Simple authentication scaffolding for Laravel
-   **[Laracasts Windmill Theme](https://github.com/laracasts/windmill-dashboard)** – Tailwind CSS-based admin dashboard UI
-   **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/installation-laravel)** – Role and permission management for Laravel applications

## 🛠️ Tech Stack

-   **HTML** – Markup structure for the UI
-   **CSS** – Base styling
-   **Tailwind CSS** – Utility-first CSS framework
-   **Laravel** – PHP framework for backend development
-   **jQuery** – JavaScript library for DOM manipulation and event handling
-   **Sortable.js** – JavaScript library enabling drag-and-drop sorting

## 📖 Explanation
This Task Manager application is designed to provide a simple and intuitive way to create, assign, and manage tasks within a team.

### 👥 User Roles
There are two types of users:

🛡️ Admin – Can create tasks and assign them to other users.

👤 Normal User – Can only create their own tasks, cannot assign them.

🎯 User roles are managed using the Spatie Laravel Permission package.

🔐 Authentication & Authorization
✨ Powered by Laravel Breeze (windmill/laracast) for user registration and login.

🔒 Role-based access control ensures:

✅ Only Admins can access task assignment features.

🧑‍💼 Regular users can create tasks but not assign them.

### 📝 Task Management
🆕 Any authenticated user can create a new task with:

Title

Description

Priority (High, Medium, Low)

🧑‍🏫 Admins can select a user from a dropdown and assign tasks.

📂 Tasks are displayed in status-based columns:

To Do

In Progress

Completed

📦 Drag & Drop Interface
💡 Powered by Sortable.js.

🖱️ Users can drag and drop task cards between columns.

🧩 Enables quick updates to task status or priority visually.

📊 Priority Sorting
Tasks can be sorted by:

🔺 High

🟡 Medium

🔻 Low

📌 This helps users focus on what’s important and urgent.

### 🌐 UI & UX
💅 Built with Tailwind CSS for a clean, responsive interface.

🧱 Dashboard design based on Laracasts Windmill Theme.

✨ Uses jQuery for small interactions like:

Menu toggling


