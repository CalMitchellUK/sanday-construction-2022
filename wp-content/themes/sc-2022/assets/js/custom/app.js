(() => {
  // Vars
  const $siteHeader = qs('#site-header')
  const $mobileToggle = qs('#primary-menu-toggle')
  const $mainNav = qs('#primary-menu')
  const $buffer = qs('#site-header-buffer')

  //
  addEventListeners()

  // Events
  function addEventListeners() {
    window.addEventListener('scroll', handleStickyHeader)
    handleStickyHeader()

    window.addEventListener('resize', handleHeaderBuffer)
    handleHeaderBuffer()

    $mobileToggle.addEventListener('click', toggleMobileMenu)
  }

  // Actions
  function handleStickyHeader() {
    $siteHeader.classList.toggle('is-stuck', window.scrollY >= 10)
  }

  function toggleMobileMenu(e) {
    e.preventDefault();
    $mainNav.classList.toggle('hidden')
  }

  function handleHeaderBuffer() {
    const headerHeight = $siteHeader.offsetHeight
    $buffer.style = `height:${headerHeight || 0}px;`
  }

  // Utils
  function qs(selector) {
    return document.querySelector(selector) ?? document.createElement('a')
  }

  function qsa(selector) {
    const $qsa = document.querySelectorAll(selector)
    return [...$qsa]
  }
})()
