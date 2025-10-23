function switchTab(tab) {
  const todayTab = document.getElementById('today-tab');
  const tomorrowTab = document.getElementById('tomorrow-tab');
  const todayContent = document.getElementById('today-content');
  const tomorrowContent = document.getElementById('tomorrow-content');

  if (tab === 'today') {
    todayTab.className = 'flex-1 text-center border-b-2 border-white font-bold text-white cursor-pointer uppercase';
    tomorrowTab.className = 'flex-1 text-center border-b-0 font-normal text-white cursor-pointer uppercase';
    todayContent.classList.remove('hidden');
    tomorrowContent.classList.add('hidden');
  } else {
    todayTab.className = 'flex-1 text-center border-b-0 font-normal text-white cursor-pointer uppercase';
    tomorrowTab.className = 'flex-1 text-center border-b-2 border-white font-bold text-white cursor-pointer uppercase';
    todayContent.classList.add('hidden');
    tomorrowContent.classList.remove('hidden');
  }
}
