# 📰 PHP News Scraper

This is a simple web scraper built with PHP and [simple_html_dom](https://simplehtmldom.sourceforge.io). It scrapes headlines from a news website (e.g., Hacker News or BBC), stores them in a MySQL database, and displays them via a clean HTML/CSS frontend.

## 💡 Features

- Scrape headlines on demand using a "Scrape Now" button
- Store data in MySQL to avoid duplicates
- Simple search functionality
- Responsive card-based UI with a custom favicon

## 🧱 Tech Stack

- PHP
- MySQL
- HTML/CSS (Vanilla)
- JavaScript (Frontend fetching logic)
- simple_html_dom PHP library

## 🚀 How to Use

1. Clone the repository
2. Set up your database (MySQL)
   CREATE DATABASE news_scraper;
   USE news_scraper;
   CREATE TABLE news_headlines (
    id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255),
     url TEXT
   );

2. Make sure your PHP config matches the DB credentials in scrape.php.
3. Download and include simple_html_dom.php from here.
4. Run your project on local server (XAMPP, etc.)
5. Open index.html in the browser.
