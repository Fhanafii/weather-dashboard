![Smart Weather Dashboard Logo](public/assets/img/logo.png)

# Smart Weather Dashboard

A modern, responsive weather dashboard built with PHP using the MVC (Model-View-Controller) architecture with user authentication. This application provides real-time weather information, air quality data, and detailed forecasts with dynamic visualizations, secured with user login and registration.

## 🌟 Features

- **User Authentication**: Secure login and registration system
- **Real-time Weather Data**: Current temperature, humidity, pressure, visibility, and wind speed
- **Air Quality Index (AQI)**: PM2.5 monitoring with status indicators
- **5-Day Forecast**: Hourly weather predictions with custom icons
- **Dynamic Temperature Graph**: Visual representation of daily temperature trends (Pagi, Siang, Sore, Malam)
- **Location-based Backgrounds**: Weather card backgrounds change based on local time (morning, dusk, night)
- **Responsive Design**: Mobile-friendly interface built with Tailwind CSS
- **Timezone Support**: Automatic timezone detection and display
- **Search Functionality**: Search for weather data by city name
- **Session Management**: Secure user sessions with logout functionality

## 🛠️ Technologies Used

- **Backend**: PHP 8.3+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, Tailwind CSS, JavaScript
- **Architecture**: MVC Pattern with Middleware
- **APIs**:
  - OpenWeatherMap API (Weather & Forecast)
  - OpenWeatherMap Air Pollution API
- **Icons**: Custom SVG weather icons
- **Fonts**: Sans-serif font family

## 📋 Prerequisites

- PHP 8.3 or higher with mysqli extension
- MySQL/MariaDB server
- Web server (Apache/Nginx) or PHP built-in server
- Internet connection for API calls
- OpenWeatherMap API key

## 🚀 Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/weather-dashboard.git
   cd weather-dashboard
   ```

2. **Set up Database**:
   - Create a MySQL/MariaDB database
   - Run the SQL script in `database_setup.sql` to create the users table

3. **Configure Database Connection**:
   - Edit `config/db.php` with your database credentials:
   ```php
   $host = 'localhost'; // Your database host
   $dbname = 'weather_dashboard'; // Your database name
   $username = 'your_db_username'; // Your database username
   $password = 'your_db_password'; // Your database password
   ```

4. **Set up API Key**:
   - Sign up for a free API key at [OpenWeatherMap](https://openweathermap.org/api)
   - Open `config/config.php` and replace the API key:
   ```php
   $API_KEY = 'your_actual_api_key_here';
   ```

5. **Start the server**:
   - Using PHP built-in server:
     ```bash
     php -S localhost:8000 -t public
     ```
   - Or configure your web server to point to the `public` directory

6. **Access the application**:
   - Open your browser and navigate to `http://localhost:8000`
   - Register a new account or login with existing credentials

## 📁 Project Structure

```
weather-dashboard/
├── app/
│   ├── controllers/
│   │   ├── WeatherController.php    # Main controller handling weather requests
│   │   ├── authController.php       # Authentication controller (login/register)
│   │   └── logout.php               # Logout handler
│   ├── middleware/
│   │   └── auth.php                 # Authentication middleware
│   ├── models/
│   │   └── WeatherModel.php         # Data layer for API interactions
│   └── views/
│       ├── dashboard.php            # Main dashboard view
│       ├── header.php               # Header template
│       └── footer.php               # Footer template
├── config/
│   ├── config.php                   # Configuration file (API keys)
│   └── db.php                       # Database configuration
├── public/
│   ├── index.php                    # Entry point (protected)
│   ├── dashboard.php                # Dashboard entry point
│   ├── login.php                    # Login page
│   ├── auth.php                     # Authentication handler
│   ├── logout.php                   # Logout handler
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css            # Custom styles
│   │   ├── js/
│   │   │   ├── datetime.js          # Date/time utilities
│   │   │   ├── search.js            # Search functionality
│   │   │   └── tabs.js              # Tab switching logic
│   │   ├── img/                     # Background images
│   │   └── icons/                   # Weather icons
│   └── .htaccess                    # URL rewriting (if using Apache)
├── database_setup.sql               # Database schema
├── .gitignore                       # Git ignore rules
├── README.md                        # This file
└── TODO.md                          # Development notes
```

## 🎯 Usage

1. **Authentication**:
   - Register a new account or login with existing credentials
   - All pages are protected and require authentication

2. **Default Location**: The dashboard loads weather data for Jakarta by default
3. **Search Cities**: Use the search bar in the top navigation to find weather for other cities
4. **View Forecasts**: Switch between "Today" and "Tomorrow" tabs in the right column
5. **Temperature Graph**: The left section shows temperature trends divided into four periods:
   - Pagi (Morning): 00:00 - 06:00
   - Siang (Afternoon): 06:00 - 12:00
   - Sore (Evening): 12:00 - 18:00
   - Malam (Night): 18:00 - 24:00
6. **Logout**: Click the logout button in the top navigation to end your session

## 🔧 Configuration

### API Configuration
Edit `config/config.php` to modify:
- API endpoints
- Default city
- Cache settings (if implemented)

### Styling
- Main styles are in `public/assets/style.css`
- Tailwind CSS is loaded via CDN
- Custom weather icons are in `public/assets/icons/`

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Weather data provided by [OpenWeatherMap](https://openweathermap.org/)
- Icons designed by the development team
- Built with [Tailwind CSS](https://tailwindcss.com/)

## 📞 Support

If you encounter any issues or have questions:
1. Check the [Issues](https://github.com/Fhanafii/weather-dashboard/issues) page
2. Create a new issue with detailed information
3. Include PHP version, browser, and error messages

---

**Note**: This is a personal project for educational purposes. Make sure to obtain proper API keys and respect API usage limits.