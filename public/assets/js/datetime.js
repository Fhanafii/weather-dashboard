// public/assets/js/datetime.js

/**
 * 🕒 updateDateTime()
 * Updates the date and time every second in Indonesian locale.
 * Now supports timezone offset based on location data.
 */
function updateDateTime(timezoneOffset = null) {
  const now = new Date();

  // If timezone offset is provided, adjust the time
  if (timezoneOffset !== null) {
    // timezoneOffset is in seconds, convert to milliseconds
    const localTime = now.getTime() + (now.getTimezoneOffset() * 60000);
    const adjustedTime = new Date(localTime + (timezoneOffset * 1000));
    now.setTime(adjustedTime.getTime());
  }

  const options = {
    weekday: 'long',
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  };
  const formatted = now.toLocaleString('id-ID', options);
  const datetimeElement = document.getElementById('datetime');
  if (datetimeElement) {
    datetimeElement.textContent = formatted;
  }
}

// Function to update timezone based on weather data
function updateTimezoneFromWeather(weatherData) {
  if (weatherData && weatherData.timezone) {
    updateDateTime(weatherData.timezone);
  } else {
    // Fallback to local time if no timezone data
    updateDateTime();
  }
}

// Initial call + refresh every second
updateDateTime();
setInterval(updateDateTime, 1000);
