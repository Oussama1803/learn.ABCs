          
# Learn ABCs Project

This repository contains a project for learning for kids. Below you'll find information on how to set up and use this project.

## Overview

The Learn ABCs project helps children learn through interactive exercises and activities.

## Installation

1. Clone this repository
2. Install required dependencies
3. Set up the database (see below)
4. Run the application

## Database Setup

This project requires a database to store user progress, alphabet data, and activity results. Follow these steps to set up the database:

### Creating the Database

Run the following SQL code to create the necessary database and tables:

```sql
-- Create the database
CREATE DATABASE kids_learning;

-- Use the database
USE kids_learning;

-- Create users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create scores table
CREATE TABLE scores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    module VARCHAR(50) NOT NULL,
    score INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username)
);
```

### Database Connection

Configure your database connection in the application settings file.

## Usage

1. Start the application
2. Create a user profile
3. Begin learning activities

## Features

- Interactive alphabet learning
- Progress tracking
- Fun examples for each letter
- Visual aids for better retention

        
