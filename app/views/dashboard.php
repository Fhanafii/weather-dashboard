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
          <span>Jakarta, Indonesia</span>
        </div>

        <!-- 🕒 Date & Time -->
        <div id="datetime" class="text-gray-600 text-sm font-medium"></div>

        <!-- Search -->
        <div class="relative">
          <input
            type="text"
            placeholder="Cari Lokasi"
            class="w-64 pl-10 pr-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400"
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
        <div class="rounded-2xl p-6 shadow flex flex-col justify-between" style="background-image: url('assets/img/sore.png'); background-size: cover; background-position: center;">
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
            <?php
            $aqi = isset($air['list'][0]['main']['aqi']) ? $air['list'][0]['main']['aqi'] : null;
            if ($aqi == 1) echo 'Baik';
            elseif ($aqi == 2) echo 'Sedang';
            elseif ($aqi == 3) echo 'Tidak Sehat';
            elseif ($aqi == 4) echo 'Sangat Tidak Sehat';
            elseif ($aqi == 5) echo 'Berbahaya';
            else echo 'Tidak diketahui';
            ?>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-3 mt-2">
            <div class="bg-yellow-400 h-3 rounded-full" style="width: <?= $aqi ? ($aqi * 20) . '%' : '0%'; ?>"></div>
          </div>
        </div>
      </div>

      <!-- Sunrise/Sunset Card -->
      <div class="col-span-2 bg-white rounded-2xl p-6 shadow flex flex-col items-center">
        <h2 class="text-lg font-semibold mb-4">Fajar & Senja</h2>
        <div class="w-full h-40 flex items-end justify-between">
          <div class="text-center">
            <p>Fajar</p>
            <p class="font-bold">
                <?= isset($weather['sys']['sunrise']) ? date('H.i', $weather['sys']['sunrise']) : '—'; ?>
            </p>
          </div>
          <div class="relative w-2/3 h-full">
            <div class="absolute bottom-0 left-0 right-0 border-b border-gray-800"></div>
            <div class="absolute bottom-0 left-0 right-0 flex justify-center items-end h-full">
              <div class="w-6 h-6 bg-yellow-400 rounded-full border-2 border-yellow-600"></div>
            </div>
          </div>
          <div class="text-center">
            <p>Senja</p>
            <p class="font-bold">
                <?= isset($weather['sys']['sunset']) ? date('H.i', $weather['sys']['sunset']) : '—'; ?>
            </p>
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
        <?php if ($forecast && isset($forecast['list'])): ?>
          <div class="space-y-4 overflow-y-auto max-h-full">
            <?php
            $today = date('Y-m-d');
            $count = 0;
            foreach ($forecast['list'] as $item):
              if ($count >= 8) break; // Show only 8 entries (24 hours / 3 hours = 8)
              $dt = date('Y-m-d', strtotime($item['dt_txt']));
              if ($dt === $today):
                $time = date('H:i', strtotime($item['dt_txt']));
                $temp = round($item['main']['temp']);
                $humidity = $item['main']['humidity'];
                $windSpeed = $item['wind']['speed'];
                $description = ucfirst($item['weather'][0]['description']);
                $icon = $item['weather'][0]['icon'];
            ?>
              <div class="bg-white bg-opacity-20 rounded-lg p-3 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <img src="https://openweathermap.org/img/wn/<?= $icon ?>@2x.png" alt="<?= $description ?>" class="w-10 h-10">
                  <div>
                    <p class="text-white font-semibold text-sm"><?= $time ?></p>
                    <p class="text-white text-xs opacity-80"><?= $description ?></p>
                  </div>
                </div>
                <div class="text-right">
                  <p class="text-white font-bold text-lg"><?= $temp ?>°C</p>
                  <p class="text-white text-xs">💧 <?= $humidity ?>% 💨 <?= $windSpeed ?> m/s</p>
                </div>
              </div>
            <?php
                $count++;
              endif;
            endforeach;
            ?>
          </div>
        <?php else: ?>
          <div class="flex items-center justify-center text-gray-400 h-full">
            <p>Data akan muncul di sini...</p>
          </div>
        <?php endif; ?>
      </div>
      <div id="tomorrow-content" class="flex-1 mt-4 hidden">
        <?php if ($forecast && isset($forecast['list'])): ?>
          <div class="space-y-4 overflow-y-auto max-h-full">
            <?php
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            $count = 0;
            foreach ($forecast['list'] as $item):
              if ($count >= 8) break; // Show only 8 entries (24 hours / 3 hours = 8)
              $dt = date('Y-m-d', strtotime($item['dt_txt']));
              if ($dt === $tomorrow):
                $time = date('H:i', strtotime($item['dt_txt']));
                $temp = round($item['main']['temp']);
                $humidity = $item['main']['humidity'];
                $windSpeed = $item['wind']['speed'];
                $description = ucfirst($item['weather'][0]['description']);
                $icon = $item['weather'][0]['icon'];
            ?>
              <div class="bg-white bg-opacity-20 rounded-lg p-3 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <img src="https://openweathermap.org/img/wn/<?= $icon ?>@2x.png" alt="<?= $description ?>" class="w-10 h-10">
                  <div>
                    <p class="text-white font-semibold text-sm"><?= $time ?></p>
                    <p class="text-white text-xs opacity-80"><?= $description ?></p>
                  </div>
                </div>
                <div class="text-right">
                  <p class="text-white font-bold text-lg"><?= $temp ?>°C</p>
                  <p class="text-white text-xs">💧 <?= $humidity ?>% 💨 <?= $windSpeed ?> m/s</p>
                </div>
              </div>
            <?php
                $count++;
              endif;
            endforeach;
            ?>
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
