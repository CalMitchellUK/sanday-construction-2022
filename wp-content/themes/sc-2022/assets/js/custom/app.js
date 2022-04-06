(() => {
  // Vars
  const $siteHeader = qs('#site-header')
  const $mobileToggle = qs('#primary-menu-toggle')
  const $mainNav = qs('#primary-menu')
  const $buffer = qs('#site-header-buffer')
  const $halfHeightOffset = qsa('.half-height-offset')

  //
  addEventListeners()

  // Events
  function addEventListeners() {
    window.addEventListener('scroll', handleWindowScroll)
    handleWindowScroll()

    window.addEventListener('resize', handleWindowResize)
    handleWindowResize()

    $mobileToggle.addEventListener('click', toggleMobileMenu)
  }

  // Actions
  function handleWindowScroll() {
    $siteHeader.classList.toggle('is-stuck', window.scrollY >= 10)
  }

  function handleWindowResize() {
    $buffer.style = `height:${$siteHeader.offsetHeight || 0}px;`

    $halfHeightOffset.forEach($el => {
      const elHeight = $el.offsetHeight
      const halfHeight = elHeight / 2
      $el.style = `margin-top: -${halfHeight}px;`
    })
  }

  function toggleMobileMenu(e) {
    e.preventDefault();
    $mainNav.classList.toggle('hidden')
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
