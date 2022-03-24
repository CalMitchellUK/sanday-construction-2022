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

const $siteHeader = document.querySelector('#site-header');
if ($siteHeader) {
  window.addEventListener('scroll', () => {
    $siteHeader.classList.toggle('is-stuck', window.scrollY >= 10)
  });
}
