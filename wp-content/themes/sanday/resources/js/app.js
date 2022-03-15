// Navigation toggle
document.addEventListener('DOMContentLoaded', function() {
  const $mainNav = document.querySelector('#primary-menu')
  const $mobileToggle = document.querySelector('#primary-menu-toggle')
  if ($mainNav && $mobileToggle) {
    $mobileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      $mainNav.classList.toggle('hidden')
    })
  }
});
