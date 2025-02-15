# PHP Project Documentation

## Overview
This project is a PHP application designed to manage project uploads. It allows users to register new uploads and view existing records through a user-friendly interface.

## File Structure
```
php-project
├── src
│   ├── engineController.php      # Contains the engineController class for managing uploads.
│   ├── main.php                   # Main entry point with HTML and PHP code for the application.
│   └── web
│       └── registros.json         # JSON file storing the records of project uploads.
├── css
│   └── styles.css                 # Styles for the application, including the popup form and "+" icon.
├── js
│   └── scripts.js                 # JavaScript code for handling popup form functionality.
└── README.md                      # Documentation for the project.
```

## Setup Instructions
1. **Clone the Repository**
   Clone the repository to your local machine using:
   ```
   git clone <repository-url>
   ```

2. **Install Dependencies**
   Ensure you have a local server environment set up (e.g., WAMP, XAMPP) to run PHP applications.

3. **File Permissions**
   Make sure that the `src/web/registros.json` file is writable by the web server.

4. **Access the Application**
   Open your web browser and navigate to `http://localhost/php-project/src/main.php` to access the application.

## Usage
- Click the "+" icon located in the bottom right corner of the application to open the form for adding a new record.
- Fill in the required fields: project data, environment, version, date, and change log.
- Submit the form to save the new record, which will be stored in `registros.json`.
- View existing records displayed on the main page.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.