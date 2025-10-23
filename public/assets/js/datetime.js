// public/assets/js/datetime.js

/**
 * 🕒 updateDateTime()
 * Updates the date and time every second in Indonesian locale.
 */
function updateDateTime() {
  const now = new Date();
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

// Initial call + refresh every second
updateDateTime();
setInterval(updateDateTime, 1000);
