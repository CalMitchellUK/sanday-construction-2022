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

document.addEventListener('DOMContentLoaded', function() {
  removeEditPost()
});
