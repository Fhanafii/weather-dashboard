<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Smart Weather Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<script src="assets/js/datetime.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/search.js"></script>
<script>
  // Initialize timezone update when page loads
  document.addEventListener('DOMContentLoaded', function() {
    // Pass weather data to update timezone
    const weatherData = <?= json_encode($weather) ?>;
    updateTimezoneFromWeather(weatherData);
  });
</script>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans">

  <!-- 🔹 Top Navbar -->
  <header class="bg-white shadow-md px-6 py-4 flex items-center justify-between rounded-b-2xl">
    <!-- Left side: Logo -->
    <div class="flex items-center space-x-2">
      <img src="assets/icons/logo.svg" alt="Logo" class="w-13 h-13 object-contain">
    </div>

    <!-- Center + Right side -->
    <div class="flex items-center space-x-4">
      <!-- Location + DateTime + Search -->
      <div class="flex items-center space-x-3">
        <!-- Location -->
        <div class="flex items-center text-gray-600 text-sm font-medium">
          <img src="assets/icons/location.svg" alt="Location Icon" class="w-5 h-5 mr-1">
          <span id="current-location">
            <?= isset($weather['name']) && isset($weather['sys']['country']) ? $weather['name'] . ', ' . $weather['sys']['country'] : 'Jakarta, Indonesia'; ?>
          </span>
        </div>

        <!-- 🕒 Date & Time -->
        <div id="datetime" class="text-gray-600 text-sm font-medium"></div>

        <!-- Search -->
        <div class="relative">
          <input
            type="text"
            placeholder="Cari Lokasi"
            class="w-64 pl-10 pr-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"
          />
          <img
            src="assets/icons/search.svg"
            alt="Search Icon"
            class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"
          />
        </div>
      </div>

      <!-- User Profile -->
      <div class="flex items-center space-x-2 border px-3 py-2 rounded-full">
        <div class="w-8 h-8 bg-[#F9802C] rounded-full"></div>
        <span class="text-gray-700 font-medium">Fahmi Hanafi</span>
      </div>
    </div>
  </header>

  <!-- 🔹 Main Content Grid -->
  <main class="flex-1 p-6 grid grid-cols-3 gap-6">
    <!-- Left Column -->
    <div class="col-span-2 grid grid-cols-2 gap-6">
      <!-- Weather Card -->
        <div class="rounded-2xl p-6 shadow flex flex-col justify-between" style="background-image: url('<?= $weather_bg ?>'); background-size: cover; background-position: center;">
        <!-- Header with icon and texts -->
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 bg-white rounded-full mr-4 flex-shrink-0 flex items-center justify-center">
            <img src="assets/icons/cloud.svg" alt="Cloud Icon" class="w-8 h-8">
          </div>
          <div class="text-left">
            <h2 class="text-lg font-semibold">Cuaca</h2>
            <p class="text-sm text-gray-600">Bagaimana cuaca hari ini</p>
          </div>
        </div>

        <!-- 🌡️ Temperature (big text) -->
        <div class="text-6xl font-extrabold mb-2 text-[#19273E]">
            <?= isset($weather['main']['temp']) ? round($weather['main']['temp']) . '°C' : '—'; ?>
        </div>

        <!-- ☀️ Condition text -->
        <p class="text-xl font-bold mb-4 text-[#19273E]">
            <?= isset($weather['weather'][0]['description']) ? ucfirst($weather['weather'][0]['description']) : 'Tidak diketahui'; ?>
        </p>

        <!-- 🌬️ Info cards row -->
        <div class="flex gap-3">
            <!-- Pressure -->
            <div class="bg-[#19273E] text-white rounded-xl flex flex-col justify-center items-start px-4 h-[96px] flex-1">
            <p class="text-xs opacity-80">Pressure</p>
            <p class="text-lg font-semibold">
                <?= isset($weather['main']['pressure']) ? $weather['main']['pressure'] . ' hPa' : '—'; ?>
            </p>
            </div>

            <!-- Visibility -->
            <div class="bg-[#CDE26B] text-[#19273E] rounded-xl flex flex-col justify-center items-start px-4 h-[96px] flex-1">
            <p class="text-xs opacity-80">Visibility</p>
            <p class="text-lg font-semibold">
                <?= isset($weather['visibility']) ? ($weather['visibility'] / 1000) . ' km' : '—'; ?>
            </p>
            </div>

            <!-- Humidity -->
            <div class="bg-[#FFFFFF] text-[#19273E] rounded-xl flex flex-col justify-center items-start px-4 h-[96px] flex-1 border border-gray-200">
            <p class="text-xs opacity-80">Humidity</p>
            <p class="text-lg font-semibold">
                <?= isset($weather['main']['humidity']) ? $weather['main']['humidity'] . '%' : '—'; ?>
            </p>
            </div>
        </div>
        </div>

      <!-- Air Quality Card -->
      <div class="rounded-2xl p-6 shadow flex flex-col" style="background-image: url('assets/img/windcloud.png'); background-size: cover; background-position: center;">
        <!-- Header with icon and texts -->
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 bg-white rounded-full mr-4 flex-shrink-0 flex items-center justify-center">
            <img src="assets/icons/wind.svg" alt="Wind Icon" class="w-8 h-8">
          </div>
          <div class="text-left">
            <h2 class="text-lg font-semibold">Kualitas Udara</h2>
            <p class="text-sm text-gray-600">
                PM2.5: <?= isset($air['list'][0]['components']['pm2_5']) ? round($air['list'][0]['components']['pm2_5']) . ' µg/m³' : '—'; ?>
            </p>
          </div>
        </div>

        <!-- Centered content -->
        <div class="flex-1 flex flex-col items-center justify-center">
          <div class="flex items-center justify-center text-6xl font-extrabold mb-2 text-[#19273E]">
              <span>
                  <?= isset($air['list'][0]['main']['aqi']) ? $air['list'][0]['main']['aqi'] : '—'; ?>
              </span>
              <span class="text-sm font-semibold ml-2 bg-white bg-opacity-80 rounded-lg px-2 py-1">AQI</span>
          </div>
          <p class="text-center text-xl font-bold mb-4 text-[#19273E]">
              <?= isset($weather['wind']['speed']) ? 'Angin ' . $weather['wind']['speed'] . ' m/s' : 'Angin tidak diketahui'; ?>
          </p>
        </div>

        <div class="mt-auto bg-[#19273E] bg-opacity-100 rounded-lg p-4">
          <div class="text-xl font-semibold inline-block px-3 py-1 rounded">
            <?= $aqi_status ?>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-3 mt-2">
            <div class="bg-yellow-400 h-3 rounded-full" style="width: <?= $aqi_progress ?>"></div>
          </div>
        </div>
      </div>

    <!-- Temperature Trend Card -->
    <div class="col-span-2 bg-white rounded-2xl p-6 shadow flex justify-between items-stretch relative">

      <!-- 🌡️ Left Section – Temperature Trend -->
      <div class="flex-1 flex flex-col justify-start items-start relative pr-6">
        <!-- Title -->
        <h2 class="text-[36px] font-bold text-gray-900 mb-6 text-left">
          Bagaimana Suhu Hari Ini?
        </h2>

        <!-- Graph Section -->
        <div class="flex justify-between items-end w-full relative pb-10">
          <!-- Pagi -->
          <div class="flex flex-col items-center flex-1 relative">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mb-2 bg-gray-100">
              <img src="assets/icons/cloudysmall.svg" alt="Pagi" class="w-7 h-7">
            </div>

            <div class="relative top-24 flex flex-col items-center">
            <p class="text-[36px] font-bold text-gray-800 mt-2"><?= $pagi_temp ?>°</p>
            <p class="text-gray-500 text-[16px] mt-1">Pagi</p>
            </div>
          </div>

          <!-- Divider -->
          <div class="absolute top-0 bottom-0 border-l border-gray-300 left-1/4"></div>

          <!-- Siang -->
          <div class="flex flex-col items-center flex-1 relative">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mb-2 bg-yellow-100">
              <img src="assets/icons/<?= $siang_icon ?>" alt="Siang" class="w-7 h-7">
            </div>

            <div class="relative top-24 flex flex-col items-center">
            <p class="text-[36px] font-bold text-gray-800 mt-2"><?= $siang_temp ?>°</p>
            <p class="text-gray-500 text-[16px] mt-1">Siang</p>
            </div>
          </div>

          <div class="absolute top-0 bottom-0 border-l border-gray-300 left-2/4"></div>

          <!-- Sore -->
          <div class="flex flex-col items-center flex-1 relative">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mb-2 bg-yellow-50">
              <img src="assets/icons/<?= $sore_icon ?>" alt="Sore" class="w-7 h-7">
            </div>
            <div class="relative top-24 flex flex-col items-center">
            <p class="text-[36px] font-bold text-gray-800 mt-2"><?= $sore_temp ?>°</p>
            <p class="text-gray-500 text-[16px] mt-1">Sore</p>
            </div>
          </div>

          <div class="absolute top-0 bottom-0 border-l border-gray-300 left-3/4"></div>

          <!-- Malam -->
          <div class="flex flex-col items-center flex-1 relative">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mb-2 bg-gray-100">
              <img src="assets/icons/moonsmall.svg" alt="Malam" class="w-7 h-7">
            </div>

            <div class="relative top-24 flex flex-col items-center">
            <p class="text-[36px] font-bold text-gray-800 mt-2"><?= $malam_temp ?>°</p>
            <p class="text-gray-500 text-[16px] mt-1">Malam</p>
            </div>
          </div>

          <!-- Curve Line -->
          <img src="assets/lines/tempcurve.svg" alt="Temperature Curve"
            class="absolute bottom-6 left-0 w-full h-20 object-contain pointer-events-none">
        </div>
      </div>

      <!-- 🌤️ Right Section – Tomorrow Summary -->
      <div class="flex-shrink-0 w-[400px] rounded-2xl p-6 flex flex-col justify-between ml-4"
        style="background-image: url('<?= $final_bg ?>'); background-size: cover; background-position: center; min-height: 100%;">
        <div class="text-left">
          <p class="text-[24px] text-white/80">Besok</p>
          <h3 class="text-[36px] font-bold text-white"><?= $location ?></h3>
        </div>
        <div class="text-left">
          <p class="text-[32px] font-bold text-white"><?= $tomorrow_temp ?></p>
          <p class="text-white text-[16px]"><?= $tomorrow_desc ?></p>
        </div>
      </div>
    </div>
    </div>

    <!-- Right Column -->
    <div class="rounded-2xl p-6 shadow flex flex-col" style="background-image: url('assets/img/bluesky.png'); background-size: cover; background-position: center;">
      <div class="flex">
        <div id="today-tab" class="flex-1 text-center border-b-2 border-white font-bold text-white cursor-pointer uppercase" onclick="switchTab('today')">Today</div>
        <div id="tomorrow-tab" class="flex-1 text-center border-b-0 font-normal text-white cursor-pointer uppercase" onclick="switchTab('tomorrow')">Tomorrow</div>
      </div>
      <div id="today-content" class="flex-1 mt-4">
        <?php if (!empty($today_forecast)): ?>
          <div class="space-y-4 overflow-y-auto max-h-full">
            <?php foreach ($today_forecast as $item): ?>
              <div class="bg-white bg-opacity-20 rounded-lg p-3 flex items-center justify-between">
                <div class="flex items-center space-x-16 pl-6">
                  <img src="<?= $item['iconSrc'] ?>" alt="<?= $item['description'] ?>" class="w-10 h-10">
                  <div class="flex flex-col items-center text-center w-40 truncate">
                    <p class="text-white font-bold text-lg"><?= $item['time'] ?></p>
                    <p class="text-white font-bold text-lg opacity-80 truncate"><?= $item['description'] ?></p>
                  </div>
                </div>
                <div class="flex items-end text-white space-x-12 text-right">
                <!-- Temperature -->
                <p class="text-[40px] font-extrabold"><?= $item['temp'] ?>°C</p>

                <!-- Humidity + Wind (stacked vertically, right aligned) -->
                <div class="flex flex-col text-xl font-semibold leading-tight items-start pr-10">
                  <p><img src="assets/icons/humidity.svg" alt="Humidity" class="w-4 h-4 inline"> <?= $item['humidity'] ?>%</p>
                  <p><img src="assets/icons/forecastwind.svg" alt="Wind" class="w-4 h-4 inline"> <?= $item['windSpeed'] ?> m/s</p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="flex items-center justify-center text-gray-400 h-full">
            <p>Data akan muncul di sini...</p>
          </div>
        <?php endif; ?>
      </div>
      <div id="tomorrow-content" class="flex-1 mt-4 hidden">
        <?php if (!empty($tomorrow_forecast)): ?>
          <div class="space-y-4 overflow-y-auto max-h-full">
            <?php foreach ($tomorrow_forecast as $item): ?>
              <div class="bg-white bg-opacity-20 rounded-lg p-3 flex items-center justify-between">
                <div class="flex items-center space-x-16 pl-6">
                  <img src="<?= $item['iconSrc'] ?>" alt="<?= $item['description'] ?>" class="w-10 h-10">
                  <div class="flex flex-col items-center text-center w-40 truncate">
                    <p class="text-white font-bold text-lg"><?= $item['time'] ?></p>
                    <p class="text-white font-bold text-lg opacity-80 truncate"><?= $item['description'] ?></p>
                  </div>
                </div>
                <div class="flex items-end text-white space-x-12 text-right">
                <!-- Temperature -->
                <p class="text-[40px] font-extrabold"><?= $item['temp'] ?>°C</p>

                <!-- Humidity + Wind (stacked vertically, right aligned) -->
                <div class="flex flex-col text-xl font-semibold leading-tight items-start pr-10">
                  <p><img src="assets/icons/humidity.svg" alt="Humidity" class="w-4 h-4 inline"> <?= $item['humidity'] ?>%</p>
                  <p><img src="assets/icons/forecastwind.svg" alt="Wind" class="w-4 h-4 inline"> <?= $item['windSpeed'] ?> m/s</p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="flex items-center justify-center text-gray-400 h-full">
            <p>Data untuk besok akan muncul di sini...</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>

</body>
</html>
