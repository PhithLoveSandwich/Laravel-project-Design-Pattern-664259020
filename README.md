# Food Forum 🍲

Food Forum is a web application built with Laravel, designed as a platform for users to share and discuss food-related topics. Users can create posts, upload images of their favorite dishes, and comment on posts from others.

---

## Features

- **User Authentication:** Secure registration and login system.
- **Post Management (CRUD):** Users can create, read, update, and delete their own posts.
- **Image Uploads:** Ability to attach an image to each post.
- **Commenting System:** Users can comment on posts to engage in discussions.
- **Responsive Design:** A clean and modern UI that works on both desktop and mobile devices.

---

## Getting Started

To get the project up and running on your local machine, please follow the instructions in the document below.

- **[➡️ How to Run the Project](./readme-run.md)**: Provides the step-by-step commands (`npm run dev`, `php artisan serve`) required to start the development servers for both frontend and backend.

---

## Technical Documentation

This project is well-documented to help developers understand its architecture and codebase. For detailed information on specific parts of the application, please refer to the following documents:

- **[📄 Project Overview](./README-PROJECT.MD)**: A detailed look into the main features and functionality of the post and comment systems.
- **[ - Database Schema](./readme-database.md)**: Describes the structure of all database tables (`users`, `posts`, `comments`), including column names, data types, and relationships.
- **[🧩 Eloquent Models](./readme-model.md)**: Explains how the `User`, `Post`, and `Comment` models are set up, including their fillable attributes and the `belongsTo`/`hasMany` relationships that connect them.
- **[⚙️ Controllers](./readme-controller.md)**: Details the logic within the application's controllers, explaining the responsibility of each method in `PostController`, `CommentController`, and others.
- **[🖥️ Pages & Views](./readme-pages.md)**: Outlines the structure of the Blade templates, explaining the purpose of each view file in the `posts` directory and how they render the application's UI.

---

This project is built on the **Laravel Framework**. For more information about the framework itself, please refer to the official [Laravel documentation](https://laravel.com/docs).
