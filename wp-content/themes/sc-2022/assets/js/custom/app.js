function addMenuToggles() {
  const $mainNav = document.querySelector('#primary-menu')
  const $mobileToggle = document.querySelector('#primary-menu-toggle')
  if ($mainNav && $mobileToggle) {
    $mobileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      $mainNav.classList.toggle('hidden')
    })
  }
}

function removeEditPost() {
  const $addNew = document.getElementById('wp-admin-bar-new-content')
  if (!$addNew) {
    return
  }
  const $addNewA = $addNew.getElementsByTagName('a')[0]
  if ($addNewA) {
    $addNewA.setAttribute('href', '#!')
  }
}

function manageStickyHeader() {
  const $siteHeader = document.querySelector('#site-header')
  if ($siteHeader) {
    window.addEventListener('scroll', () => {
      $siteHeader.classList.toggle('is-stuck', window.scrollY >= 10)
    })
  }
}

document.addEventListener('DOMContentLoaded', function() {
  addMenuToggles()
  removeEditPost()
  manageStickyHeader()
});
