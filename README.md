# Ryeify-CPS530

## Overview

Ryeify is a music platform that enhances your music experience with personalized Spotify trends, song previews, curated study playlists, lyric searches, all designed to cater to your musical needs. It was built for the CPS530 final project at Ryerson University.
It is integrated with the Spotify API for music previews and to provide user recommendations based on their history, and the Lyrics API to provide song lyrics.

## Prerequisites

Ensure you have the following software installed on your local development environment:

- **PHP** (version 8.2 or higher is recommended)
- **Composer** (dependency manager for PHP)
- **MySQL**
- **Git**

## Setup and Installation

### 1. Clone the Repository

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/CraigP17/Ryeify-CPS530.git
cd Ryeify-CPS530
```

### 2. Install Dependencies

Use Composer to install the project's dependencies:

```bash
composer install
```

This command reads the `composer.json` file and installs the necessary packages listed under `require`.

### 3. Configure Environment

Create a `config.ini` file in the private directory. You can copy the example file provided:

```bash
cp /private/example.ini config.ini
```

Open the `.ini` file and update the configuration settings according to your environment. Common settings include:

- **Database connection details** (host, database name, username, password)
- **Spotify API Details** (client id and secret keys from Spotify Developer API)

### 4. Set Up the Database

Create the database tables required by running the command listed in /dbstructure/dbstructure.php 

### 5. Serve the Application

To run the application locally, use PHP's built-in server:

```bash
php -S localhost:8080
```

