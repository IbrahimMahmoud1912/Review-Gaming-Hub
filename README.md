# 🎮 NexusReview

NexusReview is a dynamic, full-stack gaming hub and review platform. It allows users to browse a vast library of video games, read the latest industry news, check trending charts, and submit their own community reviews. 

The project utilizes a decoupled architecture, with a responsive Vanilla JS frontend communicating asynchronously with a PHP/MySQL backend API.

## ✨ Features

* **Custom API Backend:** REST-like PHP endpoints (`games.php`, `auth.php`, `reviews.php`, `news.php`) serving JSON data to the frontend.
* **Fuzzy Search Engine:** Real-time, algorithm-based search dropdown that scores matches across game titles, developers, genres, and consoles.
* **User Authentication:** Secure login and registration system with password hashing (`PASSWORD_BCRYPT`) and session management.
* **Dynamic Filtering:** Instantly filter the games grid by genre (Action RPG, FPS, etc.) and platform (PS5, PC, Switch, etc.) without page reloads.
* **Interactive Review System:** Authenticated users can submit reviews using a custom 1-100 visual slider, which instantly updates the community feed.
* **Responsive UI/UX:** Built entirely with custom CSS (no frameworks). Features a modern dark-mode aesthetic, CSS Grid/Flexbox layouts, glassmorphism navbars, and interactive hover states.

## 🛠️ Tech Stack

**Frontend:**
* HTML5 & CSS3 (Custom Variables, Animations, Grid/Flexbox)
* Vanilla JavaScript (ES6, Fetch API, DOM Manipulation)
* Fonts: *Bebas Neue*, *Barlow*, *Barlow Condensed*

**Backend & Database:**
* PHP 7.4+ 
* MySQL (Connected via PDO)
* Local Development Server: XAMPP / WAMP

## 📂 Project Structure

```text
nexusreview/
├── index.php             # Main hub, games grid, and UI logic
├── news.php              # Dedicated news viewing page
├── images/               # Directory for game and news thumbnails
├── config/
│   └── db.php            # PDO Database connection configuration
└── api/
    ├── auth.php          # API for user registration, login, and sessions
    ├── games.php         # API for fetching and filtering games
    ├── News.php          # API for fetching news articles
    └── reviews.php       # API for fetching and submitting community reviews
